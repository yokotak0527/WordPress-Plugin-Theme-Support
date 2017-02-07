<?php
  namespace theme_support;
  // ===========================================================================
  // template
  // ===========================================================================
  function display_index_page(){
    $t_domain = THEME_SUPPORT_TEXTDOMAIN;
    global $ts;
?>
<div class="wrap">
  <h1>Theme Support</h1>
  <div class="theme_support_root">
    <section>
      <h2>Method</h2>
      <p></p>
      <h3>$ts->src()</h3>
      <code><?php $ts->src(); ?></code>
      <h3>$ts->src([ where => 'user' ])</h3>
      <code><?php $ts->src([ where => 'user' ]); ?></code>
    </section>
    <section>
      <h2>ShortCode</h2>
      <p></p>
    </section>
  </div>
</div>
<?php
  };
?>
