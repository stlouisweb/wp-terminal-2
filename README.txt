=== WP-Terminal ===
Contributors: msimone
Donate link: http://0pointer.com.ar
Tags: terminal, unix, console, command, linux
Requires at least: 2.0
Tested up to: 2.9.2
Stable tag: 0.2.1

WP-Terminal provides a terminal-like box for embedding terminal commands within pages or posts.

== Description ==

WP-Terminal generates a terminal-like box around your terminal commands.

The code is a modification of WP-Syntax, a source code highlighter plugin for Wordpress (http://wordpress.org/extend/plugins/wp-syntax/screenshots/).

= Basic Usage =

Wrap terminal blocks with `<pre id="terminal" user="username" computer="computername">` and `</pre>`, being user and computer optional ("user" and "computer" will be shown if you don't provide them).  [More usage
examples](http://wordpress.org/extend/plugins/wp-terminal/other_notes/)

== Installation ==

1. Upload wp-temrinal.zip to your Wordpress plugins directory, usually `wp-content/plugins/` and unzip the file.  It will create a `wp-content/plugins/wp-terminal/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Create a post/page that contains a code snippet following the [proper usage syntax](http://wordpress.org/extend/plugins/wp-terminal/other_notes/).

== Frequently Asked Questions ==
= Q1 =

== Screenshots ==
1. Just a command, without configuration
2. The command, and <code>user</code> configuration
3. The command, <code>user</code> and <code>computer</code> configuration

== Usage ==

Wrap terminal blocks with `<pre id="terminal" user="username" computer="computername">` and `</pre>`, being user and computer optional ("user" and "computer" will be shown if you don't provide them).

**Example 1: No customized command**

    <pre id="terminal">
      ls -a
    </pre>


**Example 2: User and computer customizations**

    <pre id="terminal" user="mariano" computer="eugene">
      ls -a
    </pre>

**Example 3: Customizing just the user**

    <pre id="terminal" user="mariano">
      ls -a
    </pre>

**Example 4: Customizing just the computer**

    <pre id="terminal" computer="eugene">
      ls -a
    </pre>

**Example 5: Multiline commands**

    <pre id="terminal">
      ls
      . ..
      <br/>
      ls -a
      . .. .hiden_file
    </pre>

== Changelog ==
**0.2.1**: Replacing [prompt] keyword by the prompt and highlighting the prompt in bold (thanks to Almir Mendes (m3nd3s@gmail.com) and rudson (rudsonalves@rra.etc.br))

**0.2**: Added multiline commands

**0.1**: First release

== TODO ==
1. Allow to specify working dir
2. Allow to customize prompt
