<?php
/**
 * Project: dQuote Selection
 * Version: 2.6
 * File: Mod-dQuote.php
 * Author: digger @ http://mysmf.ru
 * License: CC BY-NC-ND 4.0 http://creativecommons.org/licenses/by-nc-nd/4.0/
 */

if (!defined('SMF'))
    die('Hacking attempt...');

/**
 * Load all needed hooks
 */
function loadDquoteHooks()
{
    add_integration_function('integrate_menu_buttons', 'addDquoteCopyright', false);
    add_integration_function('integrate_load_theme', 'loadDquoteJS', false);
}


/**
 * Add mod copyright to the forum credit's page
 */
function addDquoteCopyright()
{
    global $context;

    if ($context['current_action'] == 'credits')
        $context['copyrights']['mods'][] = '<a href="http://mysmf.ru/mods/dquote-selection" target="_blank">dQuoteSelection</a> &copy; 2007-2015, digger';
}


/**
 * Load all needed js & css
 */
function loadDquoteJS()
{
    global $context, $settings, $options, $txt;

    // TODO: don't load if user not have permissions to reply $context['can_quote'] $txt['bbc_quote']
    if ((!empty($options['display_quick_reply']) || $context['current_action'] == 'post') && !empty($context['current_topic'])) {

        loadLanguage('Dquote/');
        $txt['quote'] = $txt['bbc_quote'] = $txt['dQuoteSelection_txt'];
        $context['insert_after_template'] .= '
        <script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/dquote.js?26"></script>';
    }
}