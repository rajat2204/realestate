<?php
    use Illuminate\Support\Facades\Mail;
    
    use Perks\Helpers\Common;
    function ___alert($alert){
        if(empty($alert)){  
            if(Session::has('alert')){
                $alert = Session::get('alert');
            }
        }

        if(!empty($alert)){
            echo $alert;
        }
    }
    
    function ___encrypt($record_id) {
        return sprintf('%s%s',md5('sdh'),$record_id);
    }

    function ___decrypt($encrypted_id) {
        $encryption = md5('sdh');
        return str_replace($encryption,'', $encrypted_id);
    }    

    function __random_string($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
	function ___devices(){
        $devices = array(
            'android',
            'iphone'
        );

        return $devices;
    }

    function ___email_settings() {
        $configuration = (array)\App\Lib\Dash::combine((array)\DB::table('config')->get()->toArray(),'{n}.key','{n}.value');
        
        return array(
            'site'              => $configuration['site_name'],
            'slogan'            => $configuration['site_description'],
            'site_link'         => sprintf("%s/",asset('/')),
            'office_address'    => $configuration['office_address'],
            'help_email'        => $configuration['help_email'],
            'info_email'        => $configuration['info_email'],
        );
    }

    function ___configuration($keys = []){
        $config_table = \DB::table('config');

        if(!empty($keys)){
            $config_table->whereIn('key',$keys);
        }

        $configData = $config_table->get()->toArray();
        
        return \App\Lib\Dash::combine((array)$configData,'{n}.key','{n}.value');
    }    

    function ___mail_sender($email,$fullname,$template_code,$data) {
        if(!empty($data['attachment'])){

            $pathToFile = $data['attachment'];
        }else{
            $pathToFile='';
        }
        $template = \DB::table('emails')->select(['subject','content','variables'])->where('title',$template_code)->first();
        if(!empty($template)){
            $variables  = explode(',',$template->variables);
            $subject    = $template->subject;           
            $body       = $template->content;

            foreach ($variables as $item) {
                $subject    = str_replace($item,$data[str_replace(array('{','}'),'', $item)],stripslashes(html_entity_decode($subject)));
                $body       = str_replace($item,$data[str_replace(array('{','}'),'', $item)],stripslashes(html_entity_decode($body)));
            }

            $body = str_replace('{site}',$data['site'],$body);

            $configuration = ___configuration(['smtp_mode','smtp_host','smtp_port','smtp_username','smtp_password','site_name']);

            if($configuration['smtp_mode'] == 'ssl'){
                $configuration['smtp_host'] = sprintf("ssl://%s",$configuration['smtp_host']);
            }

            \Config::set(['port' => $configuration['smtp_port'],'host' => $configuration['smtp_host'],'username' => $configuration['smtp_username'],'password' => $configuration['smtp_password']]);

            $sender = ['subject' => $subject,'email' => $email,'name' => $fullname,'file'=>$pathToFile,'from' => ['address' => $configuration['smtp_username'],'name' => $configuration['site_name']]];

            if(!empty($body) && !empty($email)){
                Mail::send('emails.default', ['body' => $body], function($message) use ($sender){
                    if(!empty($sender['file'])){
                         $message->attach($sender['file']);

                    }
                    $message->to(
                        $sender['email'], 
                        $sender['name']
                    )
                    ->subject($sender['subject'])
                    ->from(
                        $sender['from']['address'],
                        $sender['from']['name']
                    );
                    
                });

                return true;
            }
        }
    }

    function experience_level($keys=false,$index=NULL,$language = 'en'){
        $experience_level =  [
            '0' => ['id' => 'internship', 'name' => trans('static.internship',[],NULL,$language)],
            '1' => ['id' => 'entry_level', 'name' => trans('static.entry_level',[],NULL,$language)],
            '2' => ['id' => 'associate', 'name' => trans('static.associate',[],NULL,$language)],
            '3' => ['id' => 'mid_senior_level', 'name' => trans('static.mid_senior_level',[],NULL,$language)],
            '4' => ['id' => 'executive', 'name' => trans('static.executive',[],NULL,$language)],
            '5' => ['id' => 'director', 'name' => trans('static.director',[],NULL,$language)],
            '6' => ['id' => 'not_applicable', 'name' => trans('static.not_applicable',[],NULL,$language)],
        ];

        if(!empty($index)){
            foreach ($experience_level as $key => $value) {
                if($value['id'] == $index){
                    return $value['name'];
                }
            }
        }elseif($keys == true){
            foreach ($experience_level as $key => $value) {
                $level[$value['id']] = $value['name'];
            }
            return $level;
        }else{
            return $experience_level;
        } 
    }

    function employment_type($keys=false,$index=NULL,$language = 'en'){
        $employment_type =  [
            '0' => ['id' => 'fulltime', 'name' => trans('static.fulltime',[],NULL,$language)],
            '1' => ['id' => 'parttime', 'name' => trans('static.parttime',[],NULL,$language)]
        ];

        if(!empty($index)){
            foreach ($employment_type as $key => $value) {
                if($value['id'] == $index){
                    return $value['name'];
                }
            }
        }elseif($keys == true){
            foreach ($employment_type as $key => $value) {
                $level[$value['id']] = $value['name'];
            }
            return $level;
        }else{
            return $employment_type;
        } 
    }    

    function sortingFilterCompanyUser(){

       $sortby = [
            '0' => ['id' => 'name-desc', 'name' => 'Z-A'],
            '1' => ['id' => 'name-asc', 'name' => 'A-Z'],
            '2' => ['id' => 'id-desc', 'name' => 'Latest First'],
        ];
      

        return $sortby;
    }

    function sortingFilterCompanyBranch(){

       $sortby = [
            '0' => ['id' => 'company_name-desc', 'name' => 'Z-A'],
            '1' => ['id' => 'company_name-asc', 'name' => 'A-Z'],
            '2' => ['id' => 'id-desc', 'name' => 'Latest First'],
        ];
      

        return $sortby;
    }

    function ___d($date,$format = ""){
        if(($date != '0000-00-00 00:00:00' || $date != '0000-00-00') && !empty($date) && !empty(strtotime($date))){
            $date_format = (!empty($format)) ? $format : ___configuration(['format_date'])['format_date'];
            // $time_format = ___configuration(['format_time'])['format_time'];

            if(strstr($date, '00:00:00') === false && strlen($date) == 19){
                $current_time = \Carbon\Carbon::parse($date);
                $current_time = $current_time->tz(___current_timezone());
            
                $date = $current_time->toDateTimeString();
                
                return date("{$date_format}, {$time_format}",strtotime($date));
            }else if(!empty(strtotime($date))){
                $current_time = \Carbon\Carbon::parse($date);
                $current_time = $current_time->tz(___current_timezone());
            
                $date = $current_time->toDateTimeString();
                return date($date_format, strtotime($date));
            }
        }else{
            return 'N/A';
        }
    }    

    function ___current_timezone(){
        $COUNTRY = ___country();

        if(function_exists('geoip_time_zone_by_country_and_region')){
            if(!empty(geoip_time_zone_by_country_and_region($COUNTRY))){
                return geoip_time_zone_by_country_and_region($COUNTRY);
            }else{
                return DEFAULT_TIMEZONE;
            }
        } else{
            return DEFAULT_TIMEZONE;
        }
    }
    
    function ___country(){
        if(!empty($_SERVER['GEOIP_COUNTRY_CODE'])){
            return $_SERVER['GEOIP_COUNTRY_CODE'];
        }else{
            return DEFAULT_COUNTRY_CODE;    
        }

        $IP_ADDRESS = NULL;

        if(!empty($_SERVER['REMOTE_ADDR'])){
            $IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
        }

        if(function_exists('geoip_country_code_by_name') && 0){
            $country = geoip_country_code_by_name($IP_ADDRESS);

            if(!empty($country)){
                return $country;
            }else{
                return DEFAULT_COUNTRY_CODE;
            }
        } else{
            return DEFAULT_COUNTRY_CODE;
        }
    }

    function ___t($time,$format = ""){
        if(!empty($time)){
            $format = (!empty($format))?$format:\Cache::get('configuration')['format_time'];
            $TIMEZONE = ___current_timezone();
            $current_time = \Carbon\Carbon::parse($time);
            $current_time = $current_time->tz($TIMEZONE);
        
            $date = $current_time->toDateTimeString();

            if(!empty($format)){
                $date = date($format,strtotime($date));
            }

            return $date;
        }else{
            return 'N/A';
        }
    }

    function ___dropdown_options($options,$empty = "",$selected = "",$padder = false){ 
       $html = sprintf('<option value="">%s</option>',(!empty($empty))?$empty:'Select');
       
       if(gettype($selected) == 'string' || gettype($selected) == 'integer' || gettype($selected) == 'NULL'){
           $selected = (array)$selected;
       }
       array_walk($options, function($item,$key) use($selected,&$html,$padder){
           if(empty($padder)){
               $html .= sprintf('<option value="%s"%s>%s</option>',$key,(in_array($key,$selected))?' selected':'',$item);
           }else{                
               $html .= sprintf('<option value="%\'.02d"%s>%\'.02d</option>',$key,(in_array($key,$selected))?' selected':'',$item);
           }
       });
       return $html;
    }

    function ___range($options,$type=""){
       if($type == "multi_dimension")
       {
           $range_array = (array)\App\Lib\Dash::combine(
               $options,
               '{n}.level',
               '{n}.level_name'
           );
       }else{
           $range_array = (array)\App\Lib\Dash::combine(
               $options,
               '{n}',
               '{n}'
           );
       }

       return $range_array;
    }

    function workExperienceYear($keys=false){
        $year = date('Y')-100;
        $years = [];
        for($i = date('Y'); $i >= $year; $i--){
            $years[] = ['id' =>$i, 'name' =>$i];
        }

        if($keys == true){
            $year = [];
            foreach ($years as $key => $value) {
                $year[$value['name']] = $value['name'];
            }
            return $year;
        }        

        return $years;
    }

    function educationYear($keys=false){
        $year = date('Y')-100;
        $years = [];
        for($i = date('Y'); $i >= $year; $i--){
            $years[] = ['id'=> $i, 'name' => $i];
        }

        if($keys == true){
            $year = [];
            foreach ($years as $key => $value) {
                $year[$value['name']] = $value['name'];
            }
            return $year;
        }        

        return $years;
    }

    function certificateYear ($type="start",$keys=false){
        if($type == 'start'){
            $yearlist = range((date('Y')),(date('Y') - 50));
        }else{
            $yearlist = range(date('Y'),(date('Y') + 50));
        }

        foreach ($yearlist as $key => $value) {
            $years[] = ['id' => $value, 'name' => $value];
        }

        if($keys == true){
            foreach ($years as $key => $value) {
                $year[$value['id']] = $value['name'];
            }
            return $year;
        }

        return $years;
    }

    function month($format = 'M', $monthindex=NULL,$keys=false,$lang="en"){
        $month = array(
            '01' => [trans('static.january',[],NULL,$lang),   '01', trans('static.jan',[],NULL,$lang),  '1'],
            '02' => [trans('static.february',[],NULL,$lang),  '02', trans('static.feb',[],NULL,$lang),  '2'],
            '03' => [trans('static.march',[],NULL,$lang),     '03', trans('static.mar',[],NULL,$lang),  '3'],
            '04' => [trans('static.april',[],NULL,$lang),     '04', trans('static.apr',[],NULL,$lang),  '4'],
            '05' => [trans('static.may',[],NULL,$lang),       '05', trans('static.may',[],NULL,$lang),  '5'],
            '06' => [trans('static.june',[],NULL,$lang),      '06', trans('static.june',[],NULL,$lang), '6'],
            '07' => [trans('static.july',[],NULL,$lang),      '07', trans('static.july',[],NULL,$lang), '7'],
            '08' => [trans('static.august',[],NULL,$lang),    '08', trans('static.aug',[],NULL,$lang),  '8'],
            '09' => [trans('static.september',[],NULL,$lang), '09', trans('static.sept',[],NULL,$lang), '9'],
            '10' => [trans('static.october',[],NULL,$lang),   '10', trans('static.oct',[],NULL,$lang),  '10'],
            '11' => [trans('static.november',[],NULL,$lang),  '11', trans('static.nov',[],NULL,$lang),  '11'],
            '12' => [trans('static.december',[],NULL,$lang),  '12', trans('static.dec',[],NULL,$lang),  '12']
        );

        foreach ($month as $key => $value) {
            if ($format === 'F'){
                $index = '0'; 
            }else if($format === 'm'){
                $index = '1'; 
            }else if ($format === 'M'){
                $index = '2'; 
            }else if ($format === 'n'){
                $index = '3'; 
            }else{
                $index = '0'; 
            }

            $retunMonth[] = [
                "id"    => $key,
                "name"  => $value[$index]
            ];
        }
        if(!empty($monthindex)){
            foreach ($retunMonth as $key => $value) {
                if($value['id'] == $monthindex){
                    return $value['name'];
                }
            }            
            // return array_column($retunMonth, 'name')[$monthindex - 1];
        }elseif($keys == true){
            foreach ($retunMonth as $key => $value) {
                $level[(int)$value['id']] = $value['name'];
            }
            return $level;
        }else{
            return $retunMonth;  
        }
    }

    function ilr_level($index=NULL,$language = 'en'){
        $ilr_level =  [
            '0' => [
                'id'            => 1,
                'level'         => trans('website.ilr1_level',[],NULL,$language),
                'label'         => trans('website.ilr1_label',[],NULL,$language), 
                'description'   => trans('website.ilr1_description',[],NULL,$language) 
            ],
            '1' => [
                'id'            => 2  ,
                'level'         => trans('website.ilr2_level',[],NULL,$language),
                'label'         => trans('website.ilr2_label',[],NULL,$language), 
                'description'   => trans('website.ilr2_description',[],NULL,$language) 
            ],
            '2' => [
                'id'            => 3,
                'level'         => trans('website.ilr3_level',[],NULL,$language),
                'label'         => trans('website.ilr3_label',[],NULL,$language), 
                'description'   => trans('website.ilr3_description',[],NULL,$language) 
            ],
            '3' => [
                'id'            => 4,
                'level'         => trans('website.ilr4_level',[],NULL,$language),
                'label'         => trans('website.ilr4_label',[],NULL,$language), 
                'description'   => trans('website.ilr4_description',[],NULL,$language) 
            ],
            '4' => [
                'id'            => 5,
                'level'         => trans('website.ilr5_level',[],NULL,$language),
                'label'         => trans('website.ilr5_label',[],NULL,$language),
                'description'   => trans('website.ilr5_description',[],NULL,$language)
            ]
        ];
        if(!empty($index)){
            foreach ($ilr_level as $key => $value) {
                if($value['id'] == $index){
                    return $value;
                }
            }
        }else{
            return $ilr_level;
        } 
    }

    function sharableEntity($keys=false){
        $sharableEntity = [
            '0'  => ['id' => 'education','name' => 'education'],
            '1'  => ['id' => 'skills','name' => 'skills'],
            '2'  => ['id' => 'certificate','name' => 'certificate'],
            '3'  => ['id' => 'language','name' => 'language'],
            '4'  => ['id' => 'social_media','name' => 'social_media'],
            '5'  => ['id' => 'email','name' => 'email'],
            '6'  => ['id' => 'mobile_number','name' => 'mobile_number'],
            '7'  => ['id' => 'date_of_birth','name' => 'date_of_birth'],
            '8'  => ['id' => 'gender','name' => 'gender'],
            '9'  => ['id' => 'country_work_from','name' => 'country_work_from'],
            '10' => ['id' => 'travel_willingness','name' => 'travel_willingness'],
        ];

        if($keys == true){
            foreach ($sharableEntity as $key => $value) {
                $entity[] = $value['name'];
            }
            return $entity;
        }

        return $sharableEntity;
    }

    function get_file_size($size,$conversion){
        if($conversion == 'KB'){
           return sprintf("%s KB",number_format(($size/1024),2));
        }

        return (string)$size;
    }

    function file_name($original_file_name,$original_extension){
       return sprintf("%s-%s.%s",str_replace(".","", strtoupper($original_extension)),time(),$original_extension);
   }



    function upload_file($request, $file_key_name = 'file', $folder = 'uploads/', $thumbnail = false, $resize = array()) {
        $file       = $request->file($file_key_name);
        //dd($file);
        $file_size  = get_file_size($file->getClientSize(),'KB');
        $extension  = $file->getClientOriginalExtension();
        $file_name  = file_name($file->getClientOriginalName(),$extension);
        
        // if($thumbnail == true){
        //     @mkdir(public_path(sprintf('%s%s',$folder,'thumbnail/')),0755);
        //     $thumbnail_image    = \Image::make($file->getRealPath())->fit(CROP_WIDTH)->crop(CROP_WIDTH,CROP_HEIGHT)->save(public_path(sprintf('%s%s%s',$folder,'thumbnail/',$file_name)));
        // }

        // if(!empty($resize)){
        //     @mkdir(public_path(sprintf('%s%s',$folder,'resize/')),0755);
        //     $thumbnail_image    = \Image::make($file->getRealPath())->fit($resize['width'], $resize['height'])->resize($resize['width'],$resize['height'])->save(public_path(sprintf('%s%s%s',$folder,'resize/',$file_name)));
        // }

        $file->move($folder,$file_name);

        return [
            'file_path' => public_path(sprintf('%s%s',$folder,$file_name)),
            'file_url' => asset(sprintf('%s%s',$folder,$file_name)),
            'filename' => $file_name,
            'thumbnail' => asset(sprintf('%s%s%s',$folder,'thumbnail/',$file_name)),
            'size' => $file_size,
            'extension' => $extension,
        ];
    }

    function ___menu($menu,$option = array(),$depth = 0){
        static $html = '';
        $html .= add_menu_item($menu,$option,$depth,$html);
        return $html;
    }

    function ___ago($timestamp){
        if(1/*(int)$timestamp > 0*/){
            //type cast, current time, difference in timestamps
            if(!empty(strtotime($timestamp))){
                $current_time   = \Carbon\Carbon::parse($timestamp);
                $current_time   = $current_time->tz('Asia/Kolkata');
                $timestamp      = $current_time->toDateTimeString();
                $timestamp      = strtotime($timestamp);
                $timestamp      = (int) $timestamp;

                $current_time   = date('Y-m-d H:i:s');
                $current_time   = \Carbon\Carbon::parse($current_time);
                $current_time   = $current_time->tz('Asia/Kolkata');
                $current_time   = $current_time->toDateTimeString();
                $current_time   = strtotime($current_time);

                $diff           = $current_time - $timestamp;
                $intervals      = array (
                    'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
                );

                //now we just find the difference
                if ($diff < 5){
                    return 'Just Now';
                }

                if ($diff < 10){
                    return 'Few seconds ago';
                }

                if ($diff < 59){
                    return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
                }

                if ($diff >= 60 && $diff < $intervals['hour']){
                    $diff = floor($diff/$intervals['minute']);
                    return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
                }

                if ($diff >= $intervals['hour'] && $diff < $intervals['day']){
                    $diff = floor($diff/$intervals['hour']);
                    return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
                }

                if ($diff >= $intervals['day'] && $diff < $intervals['week']){
                    $diff = floor($diff/$intervals['day']);
                    return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
                }

                if ($diff >= $intervals['week'] && $diff < $intervals['month']){
                    $diff = floor($diff/$intervals['week']);
                    return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
                }

                if ($diff >= $intervals['month'] && $diff < $intervals['year']){
                    $diff = floor($diff/$intervals['month']);
                    return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
                }

                if ($diff >= $intervals['year']){
                    $diff = floor($diff/$intervals['year']);
                    // return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
                    return 'Posted '. date('M d,Y', ($timestamp) ) ;
                }
            }
        }else{
            return N_A;
        }
    }

    function ___getmenu($section,$format,$active_class,$active_list = false,$active_value= false, $query_string = null,$footer=null){
        $html = "";
        $current_name = "";
        $result = DB::table('users_menu')->select(['name','action_url','menu_class','menu_icon'])->where(
            [
                'status' => 'active',
                'menu_section' => $section,
                'parent' => 0
            ]
        )->orderBy('menu_order','ASC')->get()->toArray();

        array_walk($result,function($item,$index) use(&$html,$active_class,$active_list,&$current_name,$query_string,$footer){
            if($active_list !== true){
                
                if((strpos(Request::path(),$item->action_url) === false)){
                    $active_class = "";
                }

                if(!empty($item->menu_class) && $footer == null){
                    $active_class = "active";
                }
            }else{
                $path = str_replace(array_map(function($item){return $item.'/';}, array_keys(language())), "", Request::path());

                if((strpos(Request::path(),$item->action_url) !== false)){
                    $item->menu_class = $active_class;
                    $active_class = "";
                    $current_name = $item->name;
                }else if((strpos($item->action_url,$path) !== false) && ($index == 0)){
                    $item->menu_class = $active_class;
                    $active_class = "";
                    $current_name = $item->name;
                }else{
                    $active_class = "";
                }
            }

            $html .= sprintf('<li class="%s"><a href="%s%s" class="%s %s">%s</a></li>',($footer == null ? $item->menu_class : 'footer-menu'),($item->action_url !== '#')?url($item->action_url):'javascript:void(0);',$query_string,$active_class,($footer == null ? $item->menu_icon : 'footer-menu'),$item->name);
        });

        if($active_value !== true){
            $current_name = "";
        }

        return sprintf($format,$current_name,$html);
    }

    function add_menu_item($menu,$option,$depth,&$html){
        $id_admin = Auth::User()->id;

        foreach ($menu as $item) {
            if(!empty($item['menu_id'])){
               // if(in_array($item['menu_id'], $admin_menus)){
                    if(empty($item['disable_list_view'])){

                        if(!empty($item['child'])){
                            $classFlag = false;
                            foreach ($item['child'] as $child) {
                                if($child['class'] == 'active ' ){
                                    $classFlag = true;
                                }else if(strpos(Request::url(),url($child['action_url'],false)) === 0){
                                    $classFlag = true;
                                }
                            }
                            if($classFlag == true){
                                $html .= '<li class="active treeview" >';
                            }else{
                                $html .= '<li class="treeview" >';
                            }
                        }else{
                            if(!empty($item['class'])){
                                $html .= '<li class="'.$item['class'].'">';
                            }else if(strpos(Request::url(),url($item['action_url'],false)) === 0){
                                $html .= '<li class="active">';
                            }else{
                                $html .= '<li>';
                            }
                        }
                    }
                    if($item['action_url'] == 'javascript:void(0);' || $item['action_url'] == '#'){
                        $item['action_url'] = 'javascript:void(0);';
                    }else{
                        $item['action_url'] = url($item['action_url'],false);
                    }

                    if(!empty($item['disable_list_view'])){
                        $html .= '<a href="'.$item['action_url'].'" class="'.$item['class'].'">'.$item['menu_icon'].'<span>'.$item['name'].'</span>';
                    }else{
                        $html .= '<a href="'.$item['action_url'].'">'.$item['menu_icon'].'<span>'.$item['name'].'</span>';
                    }
                    if($depth == 0 && !empty($item['child'])){
                        $html .= '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';
                    }

                    $html .= '</a>';

                    if(!empty($item['child'])){
                        $depth++;
                        if(!empty($option['depth'][$depth])){
                            $html .= '<ul class="'.$option['depth'][$depth].'">';
                        }else{
                            $html .= '<ul>';
                        }

                        ___menu($item['child'],$option,$depth);
                        $depth--;
                        $html .= '</ul>';
                    }
                    if(empty($item['disable_list_view'])){
                        $html .= '</li>';
                    }
                //}
            }
        }
    }

    function check_parent_category_by_id($category_id){
        return DB::table('users_menu')->where(
            array(
                'parent' => $category_id,
                
            )
        )->count();
    }
     /* MENU */

    function ___get_category_list(&$categoryList,$parent_category = 0){
        $id_admin = Auth::User()->id;
        $type = Auth::User()->user_type;
        static $index = 0;$page = "";

        $admin_menus = DB::table('get_menu_visibility')->where(
            [
                
                'user_id' => $id_admin
            ]
        )->first();
//dd(json_decode($admin_menus->menu_visibility));
        $result = DB::table('users_menu')->where(
            [
                'status' => 'active',
                'menu_section' => 'sidebar',
                'parent' => $parent_category
            ]
        )->orderBy('menu_order','ASC')->get()->toArray();
        $arr = json_decode($admin_menus->menu_visibility);
        foreach($result as $row){
            
            if(in_array($row->id, $arr)){
                $callback = $row->callback;
                $categoryList[$row->id] = array(
                    'menu_id' => $row->id,
                    'name' => $row->name,
                    'action_url' => $row->action_url,
                    'menu_icon' => $row->menu_icon,
                    'disable_list_view' => $row->disable_list_view,
                    'callback' => (!empty($row->callback) && function_exists($row->callback))?$callback():'',
                    'class' => ($page == $row->action_url)?sprintf('active %s',$row->menu_class):$row->menu_class
                );
            }
            if(check_parent_category_by_id($row->id) > 0){
                ___get_category_list($categoryList[$row->id]['child'],$row->id);
            }
        }
    }

    function ___get_user_menu($menu = array()){
        $option = array(
            'depth' => array(
                'sidebar-menu',
                'treeview-menu',
            )
        );

        ___get_category_list($menu);
        /*echo sprintf('<ul class="%s"><li class="header">MAIN NAVIGATION</li>%s</ul>',$option['depth'][0],___menu($menu,$option));*/        
        echo sprintf('<ul class="%s">%s</ul>',$option['depth'][0],___menu($menu,$option));
    }

    function sharing_eyes($key,$id=NULL){
        $data = [
            'key'          => $key,
            'id'           => !empty($id)? ___encrypt($id) : ''
        ];
        return view('front.candidate.profile.template.eyes-form',$data)->render();
    }

    function admin_sharing_eyes($key,$candidate_id=NULL,$id=NULL){
        $data = [
            'key'          => $key,
            'candidate_id' => !empty($candidate_id)? ___encrypt($candidate_id) : '',
            'id'           => !empty($id)? ___encrypt($id) : ''
        ];
        return view('admin.after_login.candidate.profile.template.eyes-form',$data)->render();
    }

    function which_eye($share_status){
        return ($share_status == 'public'?'greenEyeIcon':($share_status == 'protected'?'blueEyeIcon':'redEyeIcon'));
    }

    function whichConferenceStatus($status){
        return ($status == 'active' ? 'activeTabGreen':($status == 'locked' ? 'lockedTabRed' : ($status == 'unpublished' ?'unpublishedTabGrey':'unpublishedTabGrey')));
    }

    function ___image_base_url(){       
        return asset('/');
    }

    function has_dupes($array) {
       // streamline per @Felix
       return count($array) !== count(array_unique($array));
    }

    function ___url($url = "",$folder = "",$echo = true) {
        if($folder == 'backend'){
            $url = ADMINPATH."/$url";
        }

        if(preg_match( '/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$url)){
            if($echo == true){
                echo $url;
            }else{
                return $url;
            }
        }else{
            if($echo == true){
                echo URL::to($url);
            }else{
                if($url === '/'.ADMIN_FOLDER.'/#'){
                    return 'javascript:void(0);';
                }else{
                    return URL::to($url);
                }
            }
        }
    }

    function make_proper_url($url){
        return preg_match('/^(https?)/', $url)?$url:'//'.$url;
    }

    function conference_duration(){
        $duration = [
            '1'     => '10 Mins',
            '2'     => '20 Mins',
            '3'     => '30 Mins',
            '4'     => '40 Mins',
            '5'     => '50 Mins',
            '6'     => '60 Mins',
            '7'     => '70 Mins',
            '8'     => '80 Mins',
            '9'     => '90 Mins',
            '10'    => '100 Mins',
        ];
        return $duration;
    }

    function interview_duration(){
        $duration = [
            '1'     => '10 Mins',
            '2'     => '20 Mins',
            '3'     => '30 Mins',
            '4'     => '40 Mins',
            '5'     => '50 Mins',
            '6'     => '60 Mins',
            '7'     => '70 Mins',
            '8'     => '80 Mins',
            '9'     => '90 Mins',
            '10'    => '100 Mins',
        ];
        return $duration;
    }

    function systemUserType($keys=false,$index=NULL,$language = 'en'){
        $types = Common::systemUserType();
        $userTypes = [];
        foreach($types as $key=>$value){
            $userTypes[$value] = ucfirst(str_replace('_',' ',$value)); 
        }

        if(!empty($index)){
            foreach ($userTypes as $key => $value){
                if($key == $index){
                    return $value;
                }
            }
        }else{
            return $userTypes;
        }
    }

    function exportData($excel_name='data',$headings=[],$list,$listdata,$type,$multiple=[]){
        if(!empty($multiple)){
            foreach ($multiple as $key => $value) {
                \Excel::create($excel_name, function($excel) use ($list,$headings,$listdata) {
                    $excel->sheet($value['name'], function($sheet) use ($list,$headings,$listdata){
                        $sheet->row(1, $headings);
                        $sheet->cell('A1:I1', function($cell) {
                            $cell->setFontWeight('bold');
                        });
                        $total=count($list)+1;
                        $sheet->setBorder('A1:I'.$total, 'thin');
                        $i=2;
                        foreach ($listdata[$value['name']] as $item => $itemValue) {
                            $sheet->row($i,$itemValue);
                            $i++;
                        }
                    });
                })->download($type);
            }
        }else{
            \Excel::create($excel_name, function($excel) use ($list,$headings,$listdata) {
                $excel->sheet('mySheet', function($sheet) use ($list,$headings,$listdata){
                    $sheet->row(1, $headings);
                    $sheet->cell('A1:I1', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $total=count($list)+1;
                    $sheet->setBorder('A1:I'.$total, 'thin');
                    $i=2;
                    foreach ($listdata as $key => $value) {
                        $sheet->row($i,$value);
                        $i++;
                    }
                });
            })->download($type);
        }
    }

    function pp($data='',$die=TRUE){
        echo '<pre>';
        print_r($data);
        echo '</pre>';

        if($die)die;
    }

    function _arefy($data){
        return json_decode(json_encode($data),true);
    }

    function getIndianCurrency($number){
        $number = $number;
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
         $divider = ($i == 2) ? 10 : 100;
         $number = floor($no % $divider);
         $no = floor($no / $divider);
         $i += ($divider == 10) ? 1 : 2;
         if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
         } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
        "." . $words[$point / 10] . " " . 
              $words[$point = $point % 10] : '';
        echo $result . "Rupees  " . $points;
    }
?>