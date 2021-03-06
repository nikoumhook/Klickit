<?php $this->layout('layoutback', ['title' => 'Liste des messages du livre d\'or']) ?>

<?php $this->start('main_content') ?>
	<?php if(empty($messages)): ?>
		<p class="alert alert-danger">Aucun message trouvé</p>
	<?php else:?>
		<form>
			<table class="table table-responsive">
				<thead class="backgthead">
					<th class="optimphone">Prénom</th>
					<th class="optimphone">Nom</th>
					<th class="optimphone">Pseudonyme</th>
					<th>Commentaire</th>
					<th>Publié</th>				
					<th colspan="2">Action</th>
				</thead>

				<tbody class="backgtbody">
					<?php if(!empty($messages)): ?>
						<?php foreach($messages as $message) : ?>
							<tr>
								<td class="optimphone"><?=$message['firstname'];?></td>
								<td class="optimphone"><?=$message['lastname'];?></td>
								<td class="optimphone"><?=$message['username'];?></td>
								<td><?=substr($message['content'],0,20).'...';?></td>
								<td><?=ucfirst($message['published'])?></td>
								<td><a href="<?=$this->url('moderation', ['id'=>$message['id']])?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
								<td><button class="btn btn-danger delete-message" data-id="<?=$message['id']?>">Effacer</button></td>
							</tr>	
						<?php endforeach;?>
					<?php else: ?>
						<tr>
							<td colspan="7">Aucune information</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</form>	
	<?php endif;?>	

	<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
	<div id="pagination">
		<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left fa-fw"></i></a>':''; ?>
		Page <?= $page; ?> <?= ($nb>=1) ? '/ '.ceil($nb/$max) :''; ?>
		<?= ($nb < 1 ) ? '' : ($page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right fa-fw" aria-hidden="true"></i></a>':''); ?>
	</div>
		
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>

<script>
	$(document).ready(function(){
		
		$('.delete-message').click(function(e){
			e.preventDefault();

			var idComment = $(this).data('id');

			$.confirm({

				title: 'Supprimer un commentaire',

				content: "Êtes-vous sûr de vouloir supprimer ce commentaire ?",

				type: 'red',

				theme: 'dark',

				buttons: {
					ok: {
						text: 'Effacer le commentaire',
						btnClass: 'btn-danger',
						keys: ['enter'],
						action: function(){
			  				$.ajax({
			  					url: '<?=$this->url('ajax_delete_message_mod'); ?>',
								type: 'post',
								cache: false,
								data: {id_comment: idComment},  
								dataType: 'json',
								success: function(out){
									if(out.code == 'ok'){
						  				window.location.reload();
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