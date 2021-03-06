<?php 
	
	if($_GET['success'] == 'true'){
		$this->layout('layoutfront', ['title' => 'Paiement réussi']); 
	}
	elseif($_GET['success'] == 'false'){
		$this->layout('layoutfront', ['title' => 'Erreur dans la procédure de paiement']);
	}

?>

<?php $this->start('main_content') ?>
<div class="container">
	<div class="row">
	<?php if($_GET['success'] == 'false') : ?>
		<div class="jumbotron">
			<p>Une erreur est survenue lors de la procédure de paiement. Vous allez être rediriger vers la page d'accueil</p>
		</div>
	<?php elseif($_GET['success'] == 'true') : ?>
		<div class="col-md-6 ordermidia_width">
		<p> Merci pour votre commande. Vous pourrez consulter cette facture dans votre <a href="<?=$this->url('front_listOrders')?>" class="hoverlinkorange">historique des commande</a> </p>
	      <div class="listorder_contenu">
	          <div>
	              <div class="row">
	                  <div class="col-xs-6">
	                    <img src="<?=$this->assetUrl('/img/KLICKIT-logo-napoleon.png');?>">
	                    <p class="baseline_text">Créez l'histoire !</p>
	                  </div>
	                  <div class="col-xs-6">
	                      <p class="viewuserorder_title">FACTURE</p>      
	                  </div>      
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
	                      <p><strong>FACTURE N° <?=$idOrder['id']?></strong></p>
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
	                      <tr>
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
	                      <tr>
	                          
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
	                    <p style="line-height: 10px;">Pour toutes questions concernant cette facture, merci de me contacter à <a class="hoverlinkorange" id=" linknav-order" href="<?=$this->url('front_contact');?>">  contact@klickit.fr</a></p>
	                    <br><br>
	                    <p style="text-align:center;"><strong>MERCI DE VOTRE CONFIANCE !</strong></p>
	                </div>
	              </div>
	          </div>
	        <?php endif; ?>
	          <!--End viewuserorder table-->
	      </div>
	  </div>
	<?php endif; ?>  
	</div>	
</div>		
<?php $this->stop('main_content') ?>