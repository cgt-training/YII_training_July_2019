<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
//use common\models\User;



/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $user_image
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \common\models\User
{
    public $file;
    public $updated_at;
    /**
     * @inheritdoc
     */

    function __construct() {
        $this->updated_at = date('Y-m-d H:i:s');
    }
    public static function tableName()
    {
        return 'user';
    }

    public function afterFind ()
    {
      
        //$this->created_at = date ('Y-m-d', $this->created_at);
        //$this->updated_at = date ('Y-m-d', $this->updated_at);

        //parent::afterFind ();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
            [['username','user_first_name','user_last_name', 'password_hash', 'email'], 'required'],
            [['status'], 'integer'],
            [['username', 'user_image', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['created_at','updated_at'],'safe'],
            ['username', 'trim'],
            [['file'],'file'],
          
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique'],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'user_image' => 'User Image',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'file' => 'User Image',
        ];
    }

    public function createuser()
    {

        if (!$this->validate()) { 

            return null;
        }
        $imageName=$this->username;
        $this->file = UploadedFile::getInstance($this, 'file');            
        
        $user = new User();
        $user->username = $this->username;    
        $user->user_first_name = $this->user_first_name;    
        $user->user_last_name = $this->user_last_name;    
        $user->email = $this->email;
        $user->setPassword($this->password_hash);
        $user->generateAuthKey(); 
        $user->created_at = date('Y-m-d H:i:s');        
        $user->updated_at = date('Y-m-d H:i:s');



        if($this->file !=''){
            $this->file->saveAs('uploads/' . $imageName . '.' . $this->file->extension);
            $user->user_image='uploads/' . $imageName . '.' . $this->file->extension;
        }      
       
        return $user->save() ? $user : null;
    }


}
