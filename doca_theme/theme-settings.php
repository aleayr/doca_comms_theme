<?php

/**
 * @file
 * Theme settings.
 */

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function dcomms_theme_form_system_theme_settings_alter(&$form, $form_state) {
  // Horizontal tabs container.
  $form['group_tabs'] = array(
    '#weight' => -99,
    '#type' => 'vertical_tabs',
    '#attached' => array(
      'library' => array(
        array(
          'field_group',
          'horizontal-tabs',
          'vertical-tabs',
        ),
      ),
    ),
  );

  // Default tab.
  $form['group_tab_default'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme settings'),
    '#group' => 'group_tabs',
  );

  // Page top announcements.
  $form['page_top_announcement'] = array(
    '#type' => 'fieldset',
    '#title' => t('Announcements to appear at the top of selected pages'),
  );
  $form['page_top_announcement']['page_top_announcement_messages'] = array(
    '#type' => 'textarea',
    '#title' => t('Message to display'),
    '#default_value' => theme_get_setting('page_top_announcement_messages'),
    '#description' => t('Message to display in the announcement area.'),
  );
  $form['page_top_announcement']['page_top_announcement_paths'] = array(
    '#type' => 'textarea',
    '#title' => t('Pages the announcements are displayed'),
    '#default_value' => theme_get_setting('page_top_announcement_paths'),
    '#description' => t('Internal paths where the announcements are displayed. Enter one path per line.'),
  );
  // Cookie message.
  $form['cookie_textarea'] = array(
    '#type' => 'textarea',
    '#title' => t('Cookie Message'),
    '#default_value' => theme_get_setting('cookie_textarea'),
    '#description' => t("This is the message that will appear in the cookie notification at the top of your site."),
  );
  // RSS author.
  $form['rss_author'] = array(
    '#type' => 'textarea',
    '#title' => t('RSS Author'),
    '#default_value' => theme_get_setting('rss_author'),
    '#description' => t('Set author for each RSS feed. Enter one feed per line as <strong>path to feed,author name</strong> 
            separated by a comma. For example: <strong>news/feed,The Media Team</strong>. If no value is provided, the site 
            name will be used as the default author name.'),
  );

  foreach ($form as $k => $v) {
    if ($k == 'group_tabs') {
      continue;
    }
    if ($k !== 'group_tab_default') {
      $form['group_tab_default'][$k] = $form[$k];
      $form['group_tab_default'][$k]['#group'] = 'group_tab_default';
      unset($form[$k]);
    }
  }

  // External link popup controls.
  $form['external_link_popup'] = array(
    '#type' => 'fieldset',
    '#title' => t('External link popup'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );
  $form['external_link_popup']['external_link_enable_popup'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable external link popup'),
    '#default_value' => theme_get_setting('external_link_enable_popup'),
    '#description' => t('Display a popup modal window when an external link is clicked.'),
  );
  $form['external_link_popup']['external_link_popup_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Title text in the popup window'),
    '#default_value' => theme_get_setting('external_link_popup_title'),
    '#description' => t('Title text to be display in the external link popup.'),
  );
  $form['external_link_popup']['external_link_popup_text'] = array(
    '#type' => 'textarea',
    '#title' => t('Text in the popup window'),
    '#default_value' => theme_get_setting('external_link_popup_text'),
    '#description' => t('Text to be display in the external link popup.'),
  );

  // Site pages feedback settings.
  $form['feedback'] = array(
    '#type' => 'fieldset',
    '#title' => t('Site Pages Feedback'),
    '#description' => t("Site pages feedback settings."),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'group_tabs',
  );
  $form['feedback']['feedback_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable site pages feedback'),
    '#default_value' => theme_get_setting('feedback_enabled'),
  );
  $form['feedback']['container'] = array(
    '#type' => 'container',
    '#parents' => array('feedback'),
    '#states' => array(
      'invisible' => array(
        // If the checkbox is not enabled, show the container.
        'input[name="feedback_enabled"]' => array('checked' => FALSE),
      ),
    ),
  );
  $form['feedback']['container']['feedback_wform_nid'] = array(
    '#type' => 'select',
    '#title' => t('Choose site pages feedback form'),
    '#options' => _webform_list(),
    '#default_value' => theme_get_setting('feedback_wform_nid'),
    '#description' => t('Do not change it as this is for internal reference.'),
  );
  $form['feedback']['container']['feedback_text_init'] = array(
    '#type' => 'textfield',
    '#title' => t('The initial feedback form text'),
    '#default_value' => empty(theme_get_setting('feedback_text_init')) ? t('Was this page helpful?') : theme_get_setting('feedback_text_init'),
    '#description' => t('The initial feedback form text.'),
  );
  $form['feedback']['container']['feedback_text_ok'] = array(
    '#type' => 'textarea',
    '#title' => t('Thank you message text'),
    '#default_value' => empty(theme_get_setting('feedback_text_ok')) ? t('Thanks for your feedback') : theme_get_setting('feedback_text_ok'),
    '#description' => t('Thank you message text.'),
  );
}
