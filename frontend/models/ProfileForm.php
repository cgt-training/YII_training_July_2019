<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Profile form
 */
class ProfileForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $user_first_name;
    public $user_last_name;
    public $user_image;
    public $profile_image;
    public $updated_at;

    /**
     * {@inheritdoc}
     */

    function __construct() {
        $id = Yii::$app->user->getId();
        
        $rows = (new \yii\db\Query())
        ->select(['*'])
        ->from('user')
        ->where('id = :id', [':id' => $id])
        ->one();  
        foreach ($rows as $key => $value) {
            
            if (property_exists($this, $key)) {
                $this->$key = $rows[$key];
            }

        }
        
        $this->profile_image = $this->user_image;

        
    }

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username','custom_function_validation'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['user_first_name', 'trim'],
            ['user_first_name', 'required'],
            ['user_first_name', 'string', 'min' => 2, 'max' => 255],

            ['user_last_name', 'trim'],
            ['user_last_name', 'required'],
            ['user_last_name', 'string', 'min' => 2, 'max' => 255],
            [['user_image'], 'file'],


        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            //print_r(IMAGE_ROOT);die;
            $this->user_image->saveAs(IMAGE_ROOT.'/' . $this->user_image->baseName . '.' . $this->user_image->extension);
            return true;
        } else {
            return false;
        }
    }


    public function custom_function_validation($attribute, $params){

        
        $checkUser = $this->checkUsername($this->username);
        

        if(!empty($checkUser)){
            $this->addError($attribute,'This username has already been taken.');
        }
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */

    public function checkUsername($username)
    {

        $id = Yii::$app->user->getId();
        
        $rows = (new \yii\db\Query())
        ->select(['*'])
        ->from('user')
        //->where(['username' => $email,'id'=>'1'])
        ->where('username = :username and id != :id', [':username' => $username,':id' => $id])
        ->one();

        return $rows;

    }


    public function profile()
    {

        
        $this->user_image = UploadedFile::getInstance($this, 'user_image');
       

        if(!empty($this->user_image)){
            if ($this->upload()) {

                // file is uploaded successfully
                //return;
                $userImage = $this->user_image->name;
            }
        }else{
            $userImage = $this->profile_image;
            $this->user_image = $this->profile_image;
        }


        if (!$this->validate()) {
            return null;
        }

        $id = Yii::$app->user->getId();

      
        $is_inserted = Yii::$app->db->createCommand()->update('user', ['username' => $this->username,'email' => $this->email,'user_first_name' => $this->user_first_name,'user_last_name' => $this->user_last_name,'user_image'=>$userImage,'updated_at'=>date('Y-m-d H:i:s')], 'id = '.$id)->execute();

        return $is_inserted;

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
