<?php
    // header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
    include_once "../../../../loader.php";
    $admin = new Admin;

    // extract($_POST);
    
    // ultima verificação 07/12: na ultima analise verifiquei que não estava retornando o post do pagseguro e tambem estava sendo direcionado
    // para o endereço de notificação anterior a fatoração deste codigo

    $notificationType = 'transaction'; /* linha de teste */
    $notificationCode = 'EA3E10F4A997A997420554F6FFB5C7FD1F87'; /* linha de  teste */

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

        var_dump($xml);
        
        // $transaction = @simplexml_load_string($xml);
        
        // $data = array(
        //     'xmlRetorno'=>$xml,
        //     'inscricao_idinscricao'=>$transaction->items->item->id,
        //     'status'=>$transaction->status,
        //     'code'=>$transaction->code,
        //     'valor'=>$transaction->netAmount
        // );
        
        // if(!$admin->buscaTransacao($transaction->code)){
        //     $id = $admin->gravarTransacao($data);
        // }else{
        //     $admin->atualizarTransacao($transaction->code, $data);
        // }

        // var_dump($data);
    }

    // echo 'teste: fim de arquivo';