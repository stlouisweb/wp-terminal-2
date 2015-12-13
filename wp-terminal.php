<?php
/*
Plugin Name: WP-Terminal-2
Plugin URI: http://0pointer.com.ar/wp-terminal
Description: WP-Terminal generates a terminal-like box around your terminal commands. Wrap terminal blocks with <code>&lt;pre id="terminal" user="username" computer="computername"&gt;</code> and <code>&lt;/pre&gt;</code> being <code>user</code> and <code>computer</code> optional.
Author: Mariano Simone, Jeremy Plack
Version: 0.3.0
Author URI: http://0pointer.com.ar
*/

#
#  Copyright (c) 2009 Mariano Simone
#
#  This file is part of WP-Terminal.
#
#  WP-Terminal is free software; you can redistribute it and/or modify it under
#  the terms of the GNU General Public License as published by the Free
#  Software Foundation; either version 2 of the License, or (at your option)
#  any later version.
#
#  WP-Terminal is distributed in the hope that it will be useful, but WITHOUT ANY
#  WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
#  FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
#  details.
#
#  You should have received a copy of the GNU General Public License along
#  with WP-Terminal; if not, write to the Free Software Foundation, Inc., 59
#  Temple Place, Suite 330, Boston, MA 02111-1307 USA
#

// Override allowed attributes for pre tags in order to use <pre user=""> and <pre computer=""> in
// comments. For more info see wp-includes/kses.php
if (!CUSTOM_TAGS) {
  $allowedposttags['pre'] = array(
    'before' => array(),
    'user' => array(),
    'computer' => array(),
    'style' => array(),
    'width' => array(),
  );
  //Allow plugin use in comments
  $allowedtags['pre'] = array(
    'user' => array(),
    'computer' => array(),
    'escaped' => array(),
  );
}

function wp_terminal_head()
{
  $css_url = get_bloginfo("wpurl") . "/wp-content/plugins/wp-terminal/style/wp-terminal.css";
  if (file_exists(TEMPLATEPATH . "/wp-terminal.css"))
  {
    $css_url = get_bloginfo("template_url") . "/wp-terminal.css";
  }
  echo "\n".'<link rel="stylesheet" href="' . $css_url . '" type="text/css" media="screen" />'."\n";
}

function wp_terminal_substitute(&$match)
{
    global $wp_terminal_token, $wp_terminal_matches;

    $i = count($wp_terminal_matches);
    $wp_terminal_matches[$i] = $match;
    return "\n\n<p>" . $wp_terminal_token . sprintf("%03d", $i) . "</p>\n\n";
}

function wp_terminal_split_commands($code)
{
 return split("(<br>|<br/>)(\n|\r\n)*",$code);
}

function wp_terminal_split_lines($code)
{
 return split("\n|\r\n",$code);
}

function wp_terminal_highlight($match)
{
    global $wp_terminal_matches;

    $i = intval($match[1]);
    $match = $wp_terminal_matches[$i];

    $before = trim($match[1]);
    $before = $before ? $before : "";
    $user = trim($match[2]);
    $user = $user ? $user : "user";
    $computer = trim($match[3]);
    $computer = $computer ? $computer : "computer";
    $prompt = $before.$user."@".$computer.":$ ";
    $code = $match[4];
    $commands =  wp_terminal_split_commands($code);

    $output = "\n<div class=\"wp-terminal\">";
    foreach ($commands as $command)
    {
      $output .= $prompt;
      $lines = wp_terminal_split_lines($command);
      foreach ($lines as $line)
      {
        $output .= trim(str_replace("[prompt]", $prompt, $line . "<br/>"));
      }
    }
   $output .= "</div>\n";

    return $output;
}

function wp_terminal_before_filter($content)
{
    return preg_replace_callback(
        "/\s*<pre id=[\"']terminal[\"']\s?(?:before=[\"']([()\w-]*)[\"']|user=[\"']([\w-]*)[\"']|computer=[\"']([\w-]*)[\"']|\s?)+>(.*)<\/pre>\s*/siU",
        "wp_terminal_substitute",
        $content
    );
}

function wp_terminal_after_filter($content)
{
    global $wp_terminal_token;

     $content = preg_replace_callback(
         "/<p>\s*".$wp_terminal_token."(\d{3})\s*<\/p>/si",
         "wp_terminal_highlight",
         $content
     );

    return $content;
}

$wp_terminal_token = md5(uniqid(rand()));

// Add styling
add_action('wp_head', 'wp_terminal_head',-1);

// We want to run before other filters; hence, a priority of 0 was chosen.
// The lower the number, the higher the priority.  10 is the default and
// several formatting filters run at or around 6.
add_filter('the_content', 'wp_terminal_before_filter', 0);
add_filter('the_excerpt', 'wp_terminal_before_filter', 0);
add_filter('comment_text', 'wp_terminal_before_filter', 0);

// We want to run after other filters; hence, a priority of 99.
add_filter('the_content', 'wp_terminal_after_filter', 99);
add_filter('the_excerpt', 'wp_terminal_after_filter', 99);
add_filter('comment_text', 'wp_terminal_after_filter', 99);

?>
