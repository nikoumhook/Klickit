<?php $this->layout('layoutfront', ['title' => 'Commande utilisateur']) ?>

<?php $this->start('main_content') ?>
<div class="listorder_back">
    <div class="row">
        <div class="col-md-3">
            <img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoLeft.png');?>" id="categorycustoms">
        </div>
        <div class="col-md-6 ordermidia_width">
            <div class="listorder_contenu">
                <div>
                    <div class="row">
                        <div class="col-xs-6">
                            <img src="<?=$this->assetUrl('/img/KLICKIT-logo-napoleon.png');?>">
                            <p class="baseline_text">Créez l'histoire !</p>
                        </div>

                        <!-- ESSAI AFFICHAGE FACTURE OU COMMANDE EN FONCTION STATUT -->   
                        <?php if($order['statut'] == 'expedie') : ?> 
                        <div class="col-xs-6"><p class="viewuserorder_title" id="facture">FACTURE</p></div>
                        <?php else: ?>
                        <div class="col-xs-6"><p class="viewuserorder_title" id="commande">COMMANDE</p></div>
                        <?php endif; ?>

                        <!--
<div class="col-xs-6">
<p class="viewuserorder_title">FACTURE</p>      
</div>      
-->
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-xs-6">
                            <p>Laurent Lafont</p>
                            <p>1, résidence beau pré</p>
                            <p>33650 Saucats</p>
                            <p>Téléphone 06 11 82 17 71</p>
                        </div>
                        <div class="col-xs-6">
                            <?php if(!empty($order)) : ?>
                            <p><strong>DATE : 
                                <?php
                                $date = date_create($order['date_creation']);
                                echo date_format($date, 'd-m-Y');
                                ?>   
                                </strong></p>
                            <p><strong><span class="showcde">COMMANDE</span><span class="showfact">FACTURE</span> N° <?=$order['id']?></strong></p>
                        </div>
                    </div>
                    <br>
                    <p>N° SIRET : 753 966 464 00012</p>
                    <br><br>
                    <p><strong>Facturé à : <?=$user['firstname'].' '.$user['lastname']?></strong></p>
                </div>

                <!--viewuserorder table-->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #ccc;">
                            <tr class="tblfact">
                                <th>DESCRIPTION</th>
                                <th>Prix Unitaire</th>
                                <th>Quantité</th>
                                <th>MONTANT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $content =  explode(', ', $order['contenu']);?>
                            <?php $qte = explode(', ', $order['quantity']); ?>

                            <?php foreach($content as $key => $value) : ?>
                            <tr class="tblfact">

                                <?php $item = $get->findItems($value)?>

                                <td><?= $item['name'] ?> </td> 

                                <?php if($item['newPrice'] == 0 ) : ?>
                                <td><?=$item['price'] ?></td>

                                <?php elseif($item['newPrice'] > 0 ) : ?> 
                                <td><?=$item['newPrice']?></td>
                                <?php endif; ?> 


                                <td><?=$qte[$key]?></td>

                                <?php if($item['newPrice'] == 0 ) : ?>
                                <td><?=$item['price']*$qte[$key] ?></td>

                                <?php elseif($item['newPrice'] > 0 ) : ?> 
                                <td><?=$item['newPrice']*$qte[$key]?></td>
                                <?php endif; ?> 

                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3" style="text-align:right;"><strong>Frais de port : </strong></td>
                                <td><?=$order['shipping']?>€</td>
                            </tr> 
                            <tr>
                                <td colspan="3" style="text-align:right;"><strong>TOTAL : </strong></td>
                                <td><?=$order['total']?>€</td>
                            </tr>
                        </tbody>
                    </table>

                    <div>
                        <p style="text-align:right;">TVA non applicable, art. 293 B du CGI</p>
                        <br>
                        <div>
                            <!-- INFO PAIMENT FACTURE -->                            
                            <?php if($order['statut'] == 'expedie') : ?> 
                            <p style="line-height: 10px;">Facture réglée par <?=$order['payment']?>.</p>
                            <?php elseif($order['statut'] == 'enPreparation'): ?>
                            <p style="line-height: 10px;">Votre commande a été réglée par <?=$order['payment']?> et va être expédiée dans les plus brefs délais.</p>
                            <?php elseif($order['statut'] == 'commande'): ?>
                            <p style="line-height: 10px;">Votre commande est en attente de règlement par <?=$order['payment']?>.</p>
                            <?php endif; ?>


                            <p style="line-height: 10px;">Pour toutes questions concernant cette facture, merci de me contacter à <a class="hoverlinkorange" id=" linknav-order" href="<?=$this->url('front_contact');?>">  contact@klickit.fr</a></p>
                            <br><br>
                            <p style="text-align:center;"><strong>MERCI DE VOTRE CONFIANCE !</strong></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!--End viewuserorder table-->
                <form class="btnimpression">
                    <input id="impression" name="impression" type="button" onclick="imprimer_page()" value="Imprimer cette page">
                </form>
            </div>


        </div>
        <div class="col-md-3">
            <img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustoms" style="float:right;">
        </div>
    </div>


</div>


<?php $this->stop('main_content') ?>
<?php $this->start('js') ?>
<!-- bouton imprimer page -->
<script type="text/javascript">
    function imprimer_page(){
        window.print();
    }
</script>
<!-- afficher facture ou commande dans la page -->
<script>
    $(document).ready(function(){
        $('#facture').show(function(){
            $('.showcde').hide();
            $('.showfact').show(); 
        }); 
        $('#commande').show(function(){
            $('.showfact').hide();
            $('.showcde').show(); 
        }); 
    });

</script>

<?php $this->stop('js') ?>

