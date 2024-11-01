<?php
      $value = get_option('arrows');
       if($value == "show_arrows"){
       wp_enqueue_script( 'show-arrows', plugins_url('../assets/js/show_arrows.js', __FILE__  ), array(), true  ); 
       }
       else if($value == "hide_arrows"){
       wp_enqueue_script( 'hide-arrows', plugins_url('../assets/js/hide_arrows.js', __FILE__  ), array(), true  ); 
       }
       else if($value == "anim_with_arrows"){
       wp_enqueue_script( 'anim-with-arrows', plugins_url('../assets/js/anim_with_arrows.js', __FILE__  ), array(), true  );  
       }
       else if($value == "anim_without_arrows"){
       wp_enqueue_script( 'anim-without-arrows', plugins_url('../assets/js/anim_without_arrows.js', __FILE__  ), array(), true  );  
       }
       else{
       wp_enqueue_script( 'sic-default', plugins_url('../assets/js/sic_default.js', __FILE__  ), array(), true  );
       }
?>



