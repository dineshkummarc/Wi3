<?php defined('SYSPATH') or die ('No direct script access.'); ?>

<?php

    class Controller_Pagefiller_Default_Component_Contactform extends Controller_Pagefiller_Default_Component_Base
    {
    
		public static $componentname = "contactform";
		
        public function startEdit($field) 
        {
            // Possibly custom code here
        }
        
        public function edit($field) 
        {
    		// custom code
            $this->fielddata($field, "edittimestamp", time());
        }

        public function action_submit() {
            $field = $this->field($_POST["fieldid"]);
            $email = $this->fielddata($field, "emailaddress");
            // let's get mailing
            mail($email, "Mail van " . $_SERVER["HTTP_HOST"], $this->view("mail")->set("data", $_POST)->render());
            echo json_encode(
                Array(
                    "scriptsbefore" => Array(
                        "0" => "$(wi3.popup.getDOM()).fadeOut(100,function() { $(this).html('Bericht succesvol verzonden!').fadeIn(); } );"
                    )
                )
            );
        }
        
    }

?>