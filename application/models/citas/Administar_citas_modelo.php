   
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administar_citas_modelo extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	function agendarcita($datos){
		if($datos["id_cita"]==0){
			$datosregistro=array(
				"id_cliente" => $datos["id_cliente"],
				"id_barbero" => $datos["id_barbero"],
				"fecha" => $datos["fecha"]
			);
			$this->db->insert('citas',$datosregistro);
			log_message("error",$this->db->last_query());
			$id_cita = $this->db->insert_id();

			foreach ($datos['id_servicio'] as $key => $value) {
				$datosregistro=array(
					"id_cita" => $id_cita,
					"id_servicio" => $value,
				);
				$this->db->insert('servicioscita',$datosregistro);
				//log_message("error",$this->db->last_query());
			}


			// Get the API client and construct the service object.
			$client = $this->getClient();
			$service = new Google_Service_Calendar($client);
			log_message("debug", "CHECAR".str_replace(" ", "T", $datos['fecha']).':00-07:00');
			$event = new Google_Service_Calendar_Event(array(
			  'summary' => 'Recordatorio',
			  'location' => 'Mr. Garcés BarberShop',
			  'description' => $datos['barbero']." ".$datos['fecha'],
			  'start' => array(
			    //'dateTime' => '2018-07-07T13:34:00-07:00',
			    			   //2018-07-07T14:30-07:00
			    //2015-12-01T10:00:00.000-05:00
			    //2018-08-09T09:00.000-05:00
			    'dateTime' => str_replace(" ", "T", $datos['fecha']).':00.000-05:00',
			    'timeZone' => 'America/Mexico_City',
			  ),
			  'end' => array(
			    'dateTime' => str_replace(" ", "T", $datos['fecha']).':00.000-05:00',
			    'timeZone' => 'America/Mexico_City',
			  ),
			  'attendees' => array(
				array('email' => $datos['correocliente']),
			    array('email' => $datos['correobarbero']),
			  ),

			  'reminders' => array(
			    'useDefault' => FALSE,
			    'overrides' => array(
//			      array('method' => 'email', 'minutes' => 24 * 60),
			      array('method' => 'popup', 'minutes' => 30),
			    ),
			  ),
			));

			$calendarId = 'fernandocao@gmail.com';
			$event = $service->events->insert($calendarId, $event);
			//printf('Event created: %s\n', $event->htmlLink);


		}else{
			//update
		}
		//return array("respuesta"=>"ok");
	}

	function listarcitas($mes){
		// Get the API client and construct the service object.
		$client = $this->getClient();
		$service = new Google_Service_Calendar($client);

		// Print the next 10 events on the user's calendar.

		$calendarId = 'fernandocao@gmail.com';
		//printf('Event created: %s\n', $event->htmlLink);

		$optParams = array(
		  'timeMin' => '2018-'.$mes.'-01T00:00:00-00:00',
		  'timeMax' => '2018-'.$mes.'-31T00:00:00-00:00',
		  'orderBy' => 'startTime',
		  'singleEvents' => true,
		  'timeMin' => date('c'),
		);

		$results = $service->events->listEvents($calendarId, $optParams);

		if (empty($results->getItems())) {
		    log_message("error","Vacio");
		} else {

/*
		    foreach ($results->getItems() as $event) {
		        $start = $event->start->dateTime;
		        if (empty($start)) {
		            $start = $event->start->date;
		        }
		        log_message("error", "EVENTO: ".print_r($event), $start);
		    }
*/
			return $results->getItems();		    
		}
	}

	function getClient()
	{
	    $client = new Google_Client();
	    $client->setApplicationName('Google Calendar API PHP Quickstart');
	    $client->setScopes(Google_Service_Calendar::CALENDAR);
	    
	    $client->setAuthConfig('client_secret.json');
	    $client->setAccessType('offline');

	    // Load previously authorized credentials from a file.
	    $credentialsPath = $this->expandHomeDirectory('credentials.json');
	    //echo $credentialsPath;
	    if (file_exists($credentialsPath)) {
	        $accessToken = json_decode(file_get_contents($credentialsPath), true);
	    } else {
	        // Request authorization from the user.
	        $authUrl = $client->createAuthUrl();
	        printf("Open the following link in your browser:\n%s\n", $authUrl);
	        print 'Enter verification code: ';
	        $authCode = "4/AABXvG7WaLS4X-VxDP-1YWIBFOdCVUJk6vF3At5kVsahGSK-TuEKWyw";

	        // Exchange authorization code for an access token.
	        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

	        // Store the credentials to disk.
	        if (!file_exists(dirname($credentialsPath))) {
	            mkdir(dirname($credentialsPath), 0700, true);
	        }
	        file_put_contents($credentialsPath, json_encode($accessToken));
	        printf("Credentials saved to %s\n", $credentialsPath);
	    }
	    
	    $client->setAccessToken($accessToken);

	    // Refresh the token if it's expired.
	    if ($client->isAccessTokenExpired()) {
	        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
	        file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
	    }
	    return $client;
	}

	/**
	 * Expands the home directory alias '~' to the full path.
	 * @param string $path the path to expand.
	 * @return string the expanded path.
	 */
	function expandHomeDirectory($path)
	{
	    $homeDirectory = getenv('HOME');
	    if (empty($homeDirectory)) {
	        $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
	    }
	    return str_replace('~', realpath($homeDirectory), $path);
	}	

	function obtenercitas($id_barbero, $fecha)
	{
		$solofecha=date("Y-m-d",strtotime($fecha));
		//log_message("error", $solofecha);
		$this->db->select("TIME_FORMAT(citas.fecha, '%H:%i') as fecha, sum(servicios.duracion) as duracion");
		$this->db->from("citas");
		$this->db->join("servicioscita","servicioscita.id_cita = citas.id_cita and citas.id_barbero = ".$id_barbero);
		$this->db->join("servicios","servicios.id_servicio = servicioscita.id_servicio");
		$this->db->where("date(citas.fecha)",$solofecha);
		$this->db->group_by("citas.id_cita");
		$query = $this->db->get();
		log_message("error",$this->db->last_query());
		return $query->result();
	}

	function obtenerpersonal($tipo){
		$this->db->from("persona");
		if($tipo==5){
			$this->db->select("persona.id_persona, CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre) as nombre, facebook, instagram, telefono, correo, persona.tipo");

			$this->db->where("tipo",$tipo,false);
		}else{
			$this->db->select("persona.id_persona, CONCAT(apellido_paterno,' ',apellido_materno,' ',nombre) as nombre, tipo_de_sangre, indicaciones_medicas, GROUP_CONCAT(descripcion_habilidad) as habilidades, persona.tipo");

			$this->db->join("barbero_perfil", "barbero_perfil.id_persona = persona.id_persona");
			$this->db->join("barbero_habilidades_tecnicas", "barbero_habilidades_tecnicas.id_barbero = barbero_perfil.id_persona","left");
			$this->db->where("activo",1,false);
			$this->db->where("tipo<4");
			$this->db->group_by("persona.id_persona, tipo_de_sangre, indicaciones_medicas");
		}
		$query=$this->db->get();
		log_message("debug", $this->db->last_query());
		return $query->result();
	}
}