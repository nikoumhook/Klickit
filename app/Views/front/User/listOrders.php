<?php $this->layout('layoutfront', ['title' => 'liste commandes utilisateur']) ?>

<?php $this->start('main_content') ?>
<div class="listorder_back">
 <div class="row">
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoLeft.png');?>" id="categorycustoms">
  </div>
  <div class="col-md-6 ordermidia_width">
   <div class="listorder_contenu">
	<li style="float: left;">   
   	<img class="img-responsive" src="<?=$this->assetUrl('/img/napoPic.png');?>" id="categorycustoms">
	</li>
	<li>
	   	<h4 class="viewcategory_pages"><a href="<?=$this->url('front_affcptuser', ['id' => $_SESSION['user']['id']]);?>">Mon compte</a> <span>></span><a href="<?=$this->url('front_listOrders');?>"> Historique de commandes</a></h4>
	</li>
	<div class="clear"></div>
	<br><br>
	
	   <p class="orderMC_title">HISTORI<span style="letter-spacing: 0.01em;">Q</span>UE DE COMMANDES</p>
      <p class="orderMC_text">Vous trouverez ici vos commandes passées depuis la création de votre compte.</p>
      <hr>
	   <br>

	   <table class="table">
            <thead> 
                <tr> 
                    <th class="ordertable_title">Commande</th> 
                    <th class="ordertable_title">Date</th> 
                    <th class="ordertable_title">Prix total</th> 
                    <th class="ordertable_title">Paiement</th>
                    <th class="ordertable_title">Statut</th>
                    <th class="ordertable_title">Facture</th>
					<th></th>
                </tr> 
            </thead> 
            <tbody> 
                <tr> 
                    <td scope="row">No. 000012</td> 
                    <td>
                        <li>19-10-2016<li>
                    </td> 
                    <td><p>17.00 €<p></td>  
                    <td><p>Chèque<p></td> 
					<td><p><i class="fa fa-circle" aria-hidden="true" style="color: #56b621;"> <span class="ordertable_statut">Commande Expédiée</span></i><p></td>
                    <td><p>PDF<p></td>
					<td><p style="color:#fe941e;">détail<p></td>
                </tr>
				<tr> 
                    <td scope="row">No. 000012</td> 
                    <td>
                        <li>19-10-2016<li>
                    </td> 
                    <td><p>17.00 €<p></td>  
                    <td><p>Chèque<p></td> 
					<td><p><i class="fa fa-circle" aria-hidden="true" style="color: #999;"> <span class="ordertable_statut">En attente paiement</span></i><p></td>
                    <td><p>PDF<p></td>
					<td><p style="color:#fe941e;">détail<p></td>
                </tr>
				<tr> 
                    <td scope="row">No. 000012</td> 
                    <td>
                        <li>19-10-2016<li>
                    </td> 
                    <td><p>17.00 €<p></td>  
                    <td><p>Chèque<p></td> 
					<td><p><i class="fa fa-circle" aria-hidden="true" style="color: #fe941e;"> <span class="ordertable_statut">End cours de préparation</span></i><p></td>
                    <td><p>PDF<p></td>
					<td><p style="color:#fe941e;">détail<p></td>
                </tr>
				
            </tbody> 
        </table>
   </div>
  </div>
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustoms" style="float:right;">
  </div>
 </div>
 
 
</div>


<?php $this->stop('main_content') ?>
