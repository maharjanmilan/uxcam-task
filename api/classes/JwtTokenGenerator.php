<?php

namespace api\classes;

use Yii;
use yii\base\InvalidParamException;

class JwtTokenGenerator {

    public static function getToken($claims) {
        
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();
        
        $token = $jwt->getBuilder()
            ->issuedBy('http://api.uxcam-task.loc')
            ->permittedFor('http://api.uxcam-task.loc')
            ->identifiedBy('4f1g23a12aa', true)
            ->issuedAt($time)
            ->expiresAt($time + 3600);

        if(empty($claims) || !is_array($claims))
            throw new InvalidParamException('Claim must be an array');
        
        foreach($claims as $claimId => $claimValue) {
            $token = $token->withClaim($claimId, $claimValue);
        }
        
        $token = $token->getToken($signer, $key); // Retrieves the generated token

        return (string)$token;
    }
}