<?php
    include_once "../../../../loader.php";
    $admin = new Financeiro;

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
        $idinscricao = $transaction['items']['item']['id'];
        $xmlretorno  = json_encode($xml);

        $data = array(
                'xmlRetorno'=>$xmlretorno,
                'inscricao_idinscricao'=>$idinscricao,
                'status'=>$transaction['status'],
                'code'=>$transaction['code'],
                'valor'=>$transaction['grossAmount']
            );
            
        if(!$admin->buscaTransacaoCode($transaction['code'])){
            $id = $admin->gravarTransacao($data);
        }else{
            $admin->atualizarTransacao($transaction['code'], $data);
            switch ($data['status']) {
                case 3:
                case 4:
                    $admin->pagarComissao($data);
                    $idcertificado = $admin->gerarCertificado($transaction);
                    $datetime = date('Y-m-d H:i:s');
                    $admin->atualizaInscricao($idinscricao, array('certificado_idcertificado'=>$idcertificado, 'data_finalizacao'=>$datetime));
                break;
            }
        }
    }

