<?php

namespace app\models;
use Yii;
use yii\web\Session;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


	public function connectDb($dbName)
    {
        return Yii::$app->$dbName;
    }

	public function checkUserLoginDetails($email_address, $password)
    {

        $memberDetails = array();
        $RtConnDb = User::connectDb('rotitime');

        $validateQry = "SELECT /* " . __FILE__ . " " . __LINE__ . "  */ s_user_id,s_user_email,first_name,last_name,profile_pic_filename,is_active FROM ".RTT."." . TBL_RT_SUPER_USERS . " WHERE s_user_email = :email && password_encrypted = SHA2(:password,512) LIMIT 1";
        $memberDetails = $RtConnDb
            ->createCommand($validateQry)
            ->bindValue(':email', $email_address)
            ->bindValue(':password', $password)
            ->queryOne();

        if (!empty($memberDetails)) {
            return $memberDetails;
        } else {
            return $memberDetails;
        }

    }
	
	public function GetLoginUserId()
    {
        $LoggedInUserId = '';
		$session = Yii::$app->session;
		if ($session->has('LoggedUserId')) {
			$LoggedInUserId = $session->get('LoggedUserId');
		}
		return $LoggedInUserId;
		
	}

	public function GetLoginUserType()
    {
        $LoggedUserType = '';
		$session = Yii::$app->session;
		if ($session->has('LoggedUserType')) {
			$LoggedUserType = $session->get('LoggedUserType');
		}
        return $LoggedUserType;
    }

	public function GetLoginUserName()
    {
        $LoggedInUserName = '';
		$session = Yii::$app->session;
		if ($session->has('LoggedUserFirstName')) {
			$LoggedInUserName = $session->get('LoggedUserLastName').", ".$session->get('LoggedUserFirstName');
		}
		return $LoggedInUserName;
		
	}
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
