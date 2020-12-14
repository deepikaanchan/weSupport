<?php

namespace AppBundle\Utils\Constants;

class Constants
{

	const ACTIVE = 1;
	const ZOHO_CREATE_TICKET_URL = 'https://desk.zoho.in/api/v1/tickets';
	const METHOD_POST = 'POST';
	const METHOD_GET = 'GET';

	const create = 1;
	const list = 2;
	public static $ticketTypes = array(
		self::create => 'CREATE_TICKET',
		self::list => 'LIST_TICKET'
	);

	const high = 1;
	const medium = 2;
	const low = 3;
	public static $priorityList = array(
		self::high => 'High',
		self::medium => 'Medium',
		self::low => 'Low'
	);

	const SUCCESS = 1;
	const ERROR = 2;
}