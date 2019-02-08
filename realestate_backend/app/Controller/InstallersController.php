<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('ConnectionManager', 'Model');
ini_set('max_execution_time', 300);
class InstallersController extends AppController {
    var $uses = array();
		
    function beforeFilter() {
        if (file_exists(TMP.'installed.txt')) {
            echo 'Application already installed. Remove app/config/installed.txt to reinstall the application';
            exit();
        }
    }
		
    public function index()
    {
	$this->layout=null;
	ob_start(); 
	phpinfo(INFO_MODULES); 
	$info = ob_get_contents(); 
	ob_end_clean(); 
	$info = stristr($info, 'Client API version'); 
	preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match); 
	$mysqlversion= $match[0];
	$this->set('mysqlversion',$mysqlversion);
	$file = new File(APP.'/Config/database.php');
	if(!$file->writable())
	$this->set('dbfile','<span class="label label-danger">Unwriteable</span>');
	else
	$this->set('dbfile','<span class="label label-success">Writeable</span>');
	$file->close();
	$file = new File(APP.'/Config/core.php');
	if(!$file->writable())
	$this->set('corefile','<span class="label label-danger">Unwriteable</span>');
	else
	$this->set('corefile','<span class="label label-success">Writeable</span>');
	$file->close();
	$file = new File(TMP.'temp.txt',true,0777);
	if(!$file->writable())
	$this->set('tmpfile','<span class="label label-danger">Unwriteable</span>');
	else
	$this->set('tmpfile','<span class="label label-success">Writeable</span>');
	$file->delete();
	$file->close();	
    }
    public function step1()
    {
	$this->layout=null;
	if(!$this->request->is(array('post', 'put')))
	{
	    $this->redirect(array('action' => 'index'));
	}
	
    }
    public function step2()
    {
	$this->layout=null;
	$file = new File(APP.'/Config/database.php');
	$file->open('r');
	if(!$file->writable())
	{
	    $this->Session->setFlash("<strong>Unfortunately! File Permission Error<br>Please goto app/Config/database.php is in writable mode.",'flash', array('alert'=> 'danger'));
	    $this->redirect(array('action' => 'index'));
	    exit;
	}
	if($this->request->is(array('post', 'put')) || $file->size()>0)
	{
	    if($this->request->is(array('post', 'put')) && isset($this->request->data['Installer']['dbconnection']))
	    {
		$file = new File(APP.'Config/database.php');
		$default='$default';
		$dbLocalhost=$this->request->data['Installer']['hostname'];
		$dbName=$this->request->data['Installer']['dbname'];
		$dbUser=$this->request->data['Installer']['dbuser'];
		$dbPassword=$this->request->data['Installer']['dbpassword'];
		$dbType=$this->request->data['Installer']['dbtype'];
		$content="<?php
		class DATABASE_CONFIG {
		public $default = array(
			'datasource' => 'Database/$dbType',
			'persistent' => false,
			'host' => '$dbLocalhost',
			'login' => '$dbUser',
			'password' => '$dbPassword',
			'database' => '$dbName',
			'prefix' => '',
			'encoding' => 'utf8',
		);	
		}
		?>";
		$file->open('w',true);
		$file->write($content,'w',true);
		$file->close();
		try
		{
		    $db = ConnectionManager::getDataSource('default');		    
		}
		catch (Exception $e)
		{
		    $this -> Session -> setFlash("<strong>Unfortunately!</strong> we was unable to select database $dbName with the credentials that you had supplied us with.",'flash', array('alert'=> 'danger'));
		    $this->redirect(array('action' => 'step2'));
		}
		$this->Session->setFlash("<strong>DB $dbName test.<strong><br>A connection was successfully established with the server.",'flash',array('alert'=>'success'));
		$this->redirect(array('action' => 'step3'));
	    }
	}	
	else
	{
	    $this->redirect('/installers');
	}
    }
    public function step3()
    {
	$this->layout=null;
	$timezones = array(
                            'Pacific/Midway'        => "(GMT-11:00) Midway Island",
                            'Pacific/Apia'         => "(GMT-11:00) Samoa",
                            'Pacific/Honolulu'     => "(GMT-10:00) Hawaii",
                            'America/Anchorage'    => "(GMT-09:00) Alaska",
                            'America/Los_Angeles'  => "(GMT-08:00) Pacific Time (US & Canada)",
                            'America/Tijuana'      => "(GMT-08:00) Tijuana",
                            'America/Phoenix'      => "(GMT-07:00) Arizona",
                            'America/Denver'       => "(GMT-07:00) Mountain Time (US & Canada)",
                            'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
                            'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
                            'America/Mexico_City'  => "(GMT-06:00) Mexico City",
                            'America/Monterrey'    => "(GMT-06:00) Monterrey",
                            'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
                            'America/Chicago'      => "(GMT-06:00) Central Time (US & Canada)",
                            'America/New_York'     => "(GMT-05:00) Eastern Time (US & Canada)",
                            'America/Indiana/Indianapolis'      => "(GMT-05:00) Indiana (East)",
                            'America/Bogota'       => "(GMT-05:00) Bogota",
                            'America/Lima'         => "(GMT-05:00) Lima",
                            'America/Caracas'      => "(GMT-04:30) Caracas",
                            'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
                            'America/La_Paz'       => "(GMT-04:00) La Paz",
                            'America/Santiago'     => "(GMT-04:00) Santiago",
                            'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
                            'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
                            'America/Godthab'      => "(GMT-03:00) Greenland",
                            'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
                            'Atlantic/Azores'      => "(GMT-01:00) Azores",
                            'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
                            'Africa/Casablanca'    => "(GMT) Casablanca",
                            'Europe/Dublin'        => "(GMT) Dublin",
                            'Europe/Lisbon'        => "(GMT) Lisbon",
                            'Europe/London'        => "(GMT) London",
                            'Africa/Monrovia'      => "(GMT) Monrovia",
                            'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
                            'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
                            'Europe/Berlin'        => "(GMT+01:00) Berlin",
                            'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
                            'Europe/Brussels'      => "(GMT+01:00) Brussels",
                            'Europe/Budapest'      => "(GMT+01:00) Budapest",
                            'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
                            'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
                            'Europe/Madrid'        => "(GMT+01:00) Madrid",
                            'Europe/Paris'         => "(GMT+01:00) Paris",
                            'Europe/Prague'        => "(GMT+01:00) Prague",
                            'Europe/Rome'          => "(GMT+01:00) Rome",
                            'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
                            'Europe/Skopje'        => "(GMT+01:00) Skopje",
                            'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
                            'Europe/Vienna'        => "(GMT+01:00) Vienna",
                            'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
                            'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
                            'Europe/Athens'        => "(GMT+02:00) Athens",
                            'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
                            'Africa/Cairo'         => "(GMT+02:00) Cairo",
                            'Africa/Harare'        => "(GMT+02:00) Harare",
                            'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
                            'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
                            'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
                            'Europe/Kiev'          => "(GMT+02:00) Kyiv",
                            'Europe/Minsk'         => "(GMT+02:00) Minsk",
                            'Europe/Riga'          => "(GMT+02:00) Riga",
                            'Europe/Sofia'         => "(GMT+02:00) Sofia",
                            'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
                            'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
                            'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
                            'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
                            'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
                            'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
                            'Asia/Tehran'          => "(GMT+03:30) Tehran",
                            'Europe/Moscow'        => "(GMT+04:00) Moscow",
                            'Asia/Baku'            => "(GMT+04:00) Baku",
                            'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
                            'Asia/Muscat'          => "(GMT+04:00) Muscat",
                            'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
                            'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
                            'Asia/Kabul'           => "(GMT+04:30) Kabul",
                            'Asia/Karachi'         => "(GMT+05:00) Islamabad, Karachi",
                            'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
                            'Asia/Kolkata'         => "(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi",
                            'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
                            'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
                            'Asia/Almaty'          => "(GMT+06:00) Almaty",
                            'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
                            'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
                            'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
                            'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
                            'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
                            'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
                            'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
                            'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
                            'Australia/Perth'      => "(GMT+08:00) Perth",
                            'Asia/Singapore'       => "(GMT+08:00) Singapore",
                            'Asia/Taipei'          => "(GMT+08:00) Taipei",
                            'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
                            'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
                            'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
                            'Asia/Seoul'           => "(GMT+09:00) Seoul",
                            'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
                            'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
                            'Australia/Darwin'     => "(GMT+09:30) Darwin",
                            'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
                            'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
                            'Australia/Canberra'   => "(GMT+10:00) Canberra",
                            'Pacific/Guam'         => "(GMT+10:00) Guam",
                            'Australia/Hobart'     => "(GMT+10:00) Hobart",
                            'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
                            'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
                            'Australia/Sydney'     => "(GMT+10:00) Sydney",
                            'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
                            'Asia/Magadan'         => "(GMT+12:00) Magadan",
                            'Pacific/Auckland'     => "(GMT+12:00) Auckland",
                            'Pacific/Fiji'         => "(GMT+12:00) Fiji"
                            );
	$file = new File(APP.'/Config/database.php');
	$file->open('r');
	if($file->size()==0)
	{
	    $this->redirect('/installers');
	}
	$file->close();
	if($this->request->is(array('post', 'put')) && isset($this->request->data['Installer']['step3']) && strlen($this->request->data['Installer']['timezone'])>0)
	{
	    $this->database($this->request->data['Installer']['installdata']);
	    $this->loadModel('Configuration');
	    $this->Configuration->id=1;
	    $this->Configuration->save($this->request->data['Installer']);
	    $file = new File(APP.'/Config/core.php',false,777);
	    $tmz="date_default_timezone_set('".$this->request->data['Installer']['timezone']."');";
	    $oldtz="date_default_timezone_set('Asia/Kolkata');";
	    $file->replaceText($oldtz,$tmz);
	    $file->close();
	    $this->thanks();
	    $this->redirect(array('controller'=>'/Completes'));
	}
	$this->set('timezones',$timezones);
    }
    function database($installdata)
    {
        try
	{
	    $db = ConnectionManager::getDataSource('default');
	    if(!$db->isConnected()) {
		echo 'Could not connect to database. Please check the settings in app/Config/database.php and try again';
		exit();
	    }
	    if($installdata==1)
	    $this->__executeSQLScript($db, TMP.DS.'app_data.sql');
	    else
	    $this->__executeSQLScript($db, TMP.DS.'app.sql');
	}
	catch (Exception $e)
	{
	    $this -> Session -> setFlash('Database not found!','flash', array('alert'=> 'danger'));
	}
    }
		
    public function thanks()
    {
	try
	{
	    $file = new File(TMP.'installed.txt',true,0777);
	    if(!$file->writable())
	    {
		$this->Session->setFlash("<strong>Unfortunately! Folder Permission Error<br>Please tmp folder is in writable mode.",'flash', array('alert'=> 'danger'));
		$this->redirect(array('action' => 'step3'));
		exit;
	    }
	    $file->write(date('Y-m-d, H:i:s'),'w',true);
	    $file->close();
	}
	catch (Exception $e)
	{
	    $this->Session->setFlash("<strong>Unfortunately! Folder Permission Error<br>Please tmp folder is in writable mode.",'flash', array('alert'=> 'danger'));
	    $this->redirect(array('action' => 'step3'));
	    exit;
	}
    }
		
    function __executeSQLScript($db, $fileName) {
        $statements = file_get_contents($fileName);
        $statements = explode(';', $statements);
			
        foreach ($statements as $statement) {
            if (trim($statement) != '') {
                $db->query($statement);
            }
        }
    }    
}
?>