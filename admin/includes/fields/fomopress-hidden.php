<?php 

    $class .= ' fomopress-' . $key;

    dump( $field );

?>
<input class="<?php echo esc_attr( $class ); ?>" id="<?php echo $name; ?>" type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>">