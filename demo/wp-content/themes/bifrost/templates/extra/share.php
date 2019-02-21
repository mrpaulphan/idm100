<?php
/**
 * Share
 * 
 * Show the share icons in case
 * the neuronthemes share plugin
 * is installed and activated.
 */
if (function_exists('neuron_share_social_media')) {
    neuron_share_social_media();
} else {
    echo sprintf(
        '<i>%s</i>',
        esc_attr__('The plugin NeuronThemes share is not activated, please activate it and try it again. The plugin can be found in includes > plugins.', 'bifrost')
    );
}