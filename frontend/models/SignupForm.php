<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $imageFile;
    public $user_image;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            //[['file'], 'file'],
            [['user_image'], 'file', 'skipOnEmpty' => false],

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */

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


    public function signup()
    {
        $this->user_image = UploadedFile::getInstance($this, 'user_image');
        
        if ($this->upload()) {
            
            // file is uploaded successfully
            //return;
        }


        if (!$this->validate()) {

            return null;
        }

        $user = new User();

        
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->user_image = $this->user_image->name;
        //print_r(get_class_methods($user));
        //die;
        return $user->save() && $this->sendEmail($user);

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
