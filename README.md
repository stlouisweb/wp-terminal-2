# WP Terminal 2

WP-Terminal provides a terminal-like box for embedding terminal commands within pages or posts.    
WP-Terminal-2 extends WP-Terminal's functionality with before and workdir tags, to add text before the prompt
and add a working directory between the computer name and '$'.

## Basic Usage

Wrap terminal blocks with `<pre id="terminal" before="optional before text" user="username" computer="computername" workdir="optional working directory">` and `</pre>`, being user and computer optional ("user" and "computer" will be shown if you don't provide them, by default no before text is displayed and the working directory is shown as ~).  [More usage
examples](http://wordpress.org/extend/plugins/wp-terminal/other_notes/)
