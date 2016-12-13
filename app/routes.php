<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],

/******************** BACK *********************/

		//Routes pour le back (classé par controller)
		['GET|POST', '/back/index', 'Back#index', 'back_index'],
		['GET|POST', '/back/login', 'Back#login', 'back_login'],

		// Les routes ajax
		['GET|POST', '/ajax/logout', 'Ajax#logout', 'ajax_logout'],
		['GET|POST', '/ajax/deleteUser', 'Ajax#deleteUser', 'ajax_deleteUser'],

		//Pages liées à UserController
		['GET|POST', '/back/listUser', 'User#listUser', 'listUser'],
		['GET|POST', '/back/addUser', 'User#addUser', 'addUser'],
		['GET|POST', '/back/deleteUser/[i:id]', 'User#deleteUser', 'deleteUser'],
		['GET|POST', '/back/updateUser/[i:id]', 'User#updateUser', 'updateUser'],


		//Pages liées à MessageController
		['GET|POST', '/back/listMessage', 'Message#listMessage', 'listMessage'],
		['GET|POST', '/back/viewMessage/[i:id]', 'Message#viewMessage', 'viewMessage'],
		['GET|POST', '/back/deleteMessage/[i:id]', 'Message#deleteMessage', 'deleteMessage'],

		//Pages liées à EventController
		['GET|POST', '/back/listEvent', 'Event#listEvent', 'listEvent'],
		['GET|POST', '/back/addEvent', 'Event#addEvent', 'addEvent'],
		['GET|POST', '/back/updateEvent/[i:id]', 'Event#updateEvent', 'updateEvent'],
		['GET|POST', '/back/deleteEvent/[i:id]', 'Event#deleteEvent', 'deleteEvent'],

		//Pages liées à SlideController
		['GET|POST', '/back/listSlide', 'Slide#listSlide', 'listSlide'],
		['GET|POST', '/back/addSlide', 'Slide#addSlide', 'addSlide'],
		['GET|POST', '/back/deleteSlide/[i:id]', 'Slide#deleteSlide', 'deleteSlide'],
		['GET|POST', '/back/updateSlide/[i:id]', 'Slide#updateSlide', 'updateSlide'],

		//Pages liées à ItemController
		['GET|POST', '/back/listItem', 'Item#listItem', 'listItem'],
		['GET|POST', '/back/addItem', 'Item#addItem', 'addItem'],
		['GET|POST', '/back/deleteItem/[i:id]', 'Item#deleteItem', 'deleteItem'],
		['GET|POST', '/back/updateItem/[i:id]', 'Item#updateItem', 'updateItem'],

		//Pages liées à OrdersController
		['GET|POST', '/back/listOrders', 'Orders#listOrders', 'listOrders'],
		['GET|POST', '/back/viewOrder/[i:id]', 'Orders#viewOrders', 'viewOrders'],


		//Pages liées à ShippingController
		['GET|POST', '/back/listShipping', 'Shipping#listShipping', 'listShipping'],
		['GET|POST', '/back/addShipping', 'Shipping#addShipping', 'addShipping'],
		['GET|POST', '/back/deleteShipping/[i:id]', 'Shipping#deleteShipping', 'deleteShipping'],

		//Pages liées à GuestbookController
		['GET|POST', '/back/listGuestbook', 'Guestbook#listGuestbook', 'listGuestbook'],
		['GET|POST', '/back/moderation', 'Guestbook#moderation', 'moderation'],



/******************** FRONT *********************/

//Routes pour le front (classé par controller)


		//Pages liées à FrontController
		['GET|POST', '/front/index', 'Front#index', 'front_index'],
		['GET|POST', '/front/login', 'Front#login', 'front_login'],
		['GET|POST', '/front/aPropos', 'Front#aPropos', 'front_aPropos'],
		['GET|POST', '/front/cgv', 'Front#cgv', 'front_cgv'],
		['GET|POST', '/front/contact', 'Front#contact', 'front_contact'],
		['GET|POST', '/front/legalMention', 'Front#legalMention', 'front_legalMention'],

		//Pages liées à UserController
		['GET|POST', '/front/addUser', 'FrontUser#faddUser', 'front_faddUser'],
		['GET|POST', '/front/cptUser', 'FrontUser#affCptUser', 'front_affcptuser'],
		['GET|POST', '/front/fUpdateUser', 'FrontUser#fupdateUser', 'front_fUpdateUser'],

		//Pages liées à FrontItemController
		['GET|POST', '/front/listItemClassics', 'FrontItem#listItemClassics', 'listItemClassics'],
		['GET|POST', '/front/listItemCustoms', 'FrontItem#listItemCustoms', 'listItemCustoms'],
		['GET|POST', '/front/listItemDivers', 'FrontItem#listItemDivers', 'listItemDivers'],
		['GET|POST', '/front/listItemPieces', 'FrontItem#listItemPieces', 'listItemPieces'],
		['GET|POST', '/front/searchItems', 'FrontItem#searchItems', 'searchItems'],

		//Pages liées à FrontGuestbookController
		['GET|POST', '/front/fGuestbook', 'FrontGuestbook#affGuestbook', 'fGuestbook'],

		//Pages liées à FrontOrdersController
		['GET|POST', '/front/listOrders', 'FrontOrders#FrontListOrders', 'front_listOrders'],
		['GET|POST', '/front/viewUserOrder', 'FrontOrders#FrontviewOrders', 'front_viewUserOrder'],

		['GET|POST', '/front/viewUserOrder', 'FrontOrders#FrontviewOrders', 'front_viewUserOrder'],
		['GET|POST', '/front/viewUserOrder', 'FrontOrders#FrontviewOrders', 'front_viewUserOrder'],
		['GET|POST', '/front/viewUserOrder', 'FrontOrders#FrontviewOrders', 'front_viewUserOrder'],
		['GET|POST', '/front/viewUserOrder', 'FrontOrders#FrontviewOrders', 'front_viewUserOrder'],

	);