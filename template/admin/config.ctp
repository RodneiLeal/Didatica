<form action="controllers/adm/config.php" method="POST">
        <input type="hidden" name="idconfig" value="<?=$cfg['idconfig']?>">
    <p>
        <label for="">número de questões</label>
        <input type="text" name="n_questoes" value="<?=$cfg['n_questoes']?>">
    </p>
    <p>
        <label for="">Nota de corte</label>
        <input type="text" name="nota_corte" value="<?=$cfg['nota_corte']?>">
    </p>
    <p>
        <label for="">Unidade monetária</label>
        <select name="unid_monet">
            <option value="BRL">BRL</option>
        </select>
        <span><?=$cfg['unid_monet']?></span>
    </p>
    <p>
        <label for="">Valor do certificado</label>
        <input type="text" name="certificado_valor" value="<?=$cfg['certificado_valor']?>">
    </p>
    <p>
        <label for="">Comissão</label>
        <input type="text" name="comissao" value="<?=$cfg['comissao']?>">
    </p>
    <p>
        <label for="">Crédito mínimo para saque</label>
        <input type="text" name="min_saque" value="<?=$cfg['min_saque']?>">
    </p>
    <p>
        <label for="">CEO</label>
        <input type="text" name="ceo" value="<?=$cfg['ceo']?>">
    </p>
    <p>
        <label for="">CET</label>
        <input type="text" name="cet" value="<?=$cfg['cet']?>">
    </p>
    
    
    <p>
        <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
    </p>
</form>