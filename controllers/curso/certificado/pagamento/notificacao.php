<?php
    include_once "../../../../loader.php";
    $admin = new Admin;

    extract($_POST);

    if(isset($notificationType) && $notificationType == 'transaction'){

        $url = PGS_URL_NOTIFICACAO.$notificationCode.'?email='.PGS_EMAIL.'&token='.PGS_TOKEN;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $xml = curl_exec($curl);
        
        curl_close($curl);

        if($xml == 'Unauthorized'){
            exit;
        }

        $transaction = $admin->object2array($xml = @simplexml_load_string($xml));

        $data = array(
                'xmlRetorno'=>json_encode($xml),
                'inscricao_idinscricao'=>$transaction['items']['item']['id'],
                'status'=>$transaction['status'],
                'code'=>$transaction['code'],
                'valor'=>$transaction['grossAmount']
            );

            
        if(!$admin->buscaTransacaoCode($transaction['code'])){
            $id = $admin->gravarTransacao($data);
        }else{
            $admin->atualizarTransacao($transaction['code'], $data);
        }
    }