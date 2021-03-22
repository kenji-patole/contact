<!-- <form method="GET" action="<?php //echo base_url('/LienEtRedirection/index') ?>">
    <input name="email" placeholder="email"></input>
    <input type="text" name="page"></input>
    <button type="submit">Envoyer</button>
 
</form> -->

<!-- <form method="POST" action="<?php //echo base_url('/Formulaire/index') ?>">
    <input name="email" placeholder="email"></input>
    <br>
    <?php if(isset($validation) && $validation->hasError('email')) {
        echo 'Une adresse email est requise'; } ?><br>
    <button type="submit">Envoyer</button>
</form> -->

<form method="POST" action="<?php echo base_url('formulaire/index')?>">
    <input type="hidden" name="monFormulaire" value="true"></input>
    <input type="text" name="nom"></input><br>
        <?php if(!empty($validation) && $validation->hasError('nom') && $request->getVar('monFormulaire')=="true") {
            echo $validation->getError('nom'); } ?><br>
    <input type="text" name="prenom"></input><br>
        <?php if(!empty($validation) && $validation->hasError('prenom') && $request->getVar('monFormulaire')=="true") {
            echo $validation->getError('prenom'); } ?><br>
    <button type="submit">Envoyer</button>
    
</form>