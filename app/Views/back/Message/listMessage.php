<?php $this->layout('layoutback', ['title' => 'Liste des messages reçus ']) ?>

<?php $this->start('main_content') ?>
	<?php if(empty($messages)):?>
		<p class="alert alert-danger">Aucun message trouvé</p>
	<?php else:?>
		<form>	
			<table class="table table-responsive">
				<thead>
					<th>Pseudonyme</th>
					<th>Adresse email</th>
					<th>Sujet</th>
					<th>Contenu</th>
					<th>Statut</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody>
					<?php foreach($messages as $message) : ?>
						<?php 
							if ($message['statut'] == 'Non lu'){
								$bold = ' style="font-weight:bold;" ';
							}else{
								$bold = '';
							}
						?>
						<tr>
							<td <?=$bold?> ><?=$message['username'];?></td>
							<td <?=$bold?> ><?=$message['email'];?></td>
							<td <?=$bold?> ><?=$message['subject'];?></td> 
							<td <?=$bold?> ><?=$message['content'];?></td>
							<td <?=$bold?> ><?=$message['statut'];?></td>
							<td><a href="<?=$this->url('viewMessage', ['id'=>$message['id']]);?>">Voir le message</a></td>
							<td><button class="btn btn-danger delete-message" data-id="<?=$message['id']?>">Effacer le message</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
		</form>
	<?php endif;?>	

	<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
	<div>
		<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>':''; ?>
		Page <?= $page; ?> / <?= ceil($nb/$max); ?>
		<?= $page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>':''; ?>
	</div>				
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
<script>
	$(document).ready(function(){
		
		$('.delete-message').click(function(e){
			e.preventDefault();

			var idMessage = $(this).data('id');

			$.confirm({

				title: 'Supprimer un message',

				content: "Êtes-vous sûr de vouloir supprimer cet message ?",

				type: 'red',

				theme: 'dark',

				buttons: {
					ok: {
						text: 'Effacer le message',
						btnClass: 'btn-danger',
						keys: ['enter'],
						action: function(){
			  				$.ajax({
			  					url: '<?=$this->url('ajax_deleteMessage'); ?>',
								type: 'post',
								cache: false,
								data: {id_message: idMessage},  // $_POST['id_user']
								dataType: 'json',
								success: function(out){
									if(out.code == 'ok'){
						  				window.location.href=window.location.href;	
									}
								}
			  				});
			  				
		  				}
					},
					cancel: function(button) {
					   
					}
				}
			});

		});
	});
</script>
<?php $this->stop('js')?>
