# The Only Thing To Do

There is nothing you need to do to use this plugin. Simply activate it.

There is one filter you can use to modify the user meta values you want to hijack. Simply feed the `ac_user_metas` filter with an array of key value pairs.

The default options being set are:

```
$metas = array(
	'admin_color'		=> 'fresh',
	'comment_shortcuts'	=> true,
	'use_ssl'			=> 0,
	'aim'				=> '',
	'yim'				=> '',
	'jabber'			=> '',
	'googleplus'		=> '',
	'primary_blog'		=> '1',
	'nickname'			=> ''
);
```

To replace my provided values with your own, in your own plugin or theme, simply do:

```
class Foo {
  public function __construct() {
		$this->hooks();
	}

	public function hooks() {
		add_filter( 'ac_user_meta', array( $this, 'my_values' ) );
	}

	public function my values( $values ) {
		return array( 'admin_color' => 'classic', 'use_ssl' => true );
	}
}
new Foo;
```

To Use my defaults and add your own and replace some of mine with your own, you might do something like this:
```
class Foo {
  public function __construct() {
		$this->hooks();
	}

	public function hooks() {
		add_filter( 'ac_user_meta', array( $this, 'my_values' ) );
	}

	public function my values( $values ) {
		$my_values = array( 'admin_color' => 'classic', 'rich_editing' => false );
		return array_merge( $values, $my_values );
	}
}
new Foo;
```
