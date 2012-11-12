				<div class="clear"></div>
				
			</div>
		
			<footer id="footer">
		
				<div class="backtotop">
					<a href="<?php echo Options::out('habari') ?>/atom/1" rel="nofollow">feed<img src="<?php Site::out_url( 'theme' ); ?>/img/feed.png" alt="Atom" height="14" widht="14"/></a>
					<a href="#top" id="up">top<img src="<?php Site::out_url( 'theme' ); ?>/img/up.png" alt="" height="20" width="20" /></a>
				</div>
		
				<div class="footy">
					<p class="footer"><?php Options::out('title'); ?> runs with <a href="http://www.habariproject.org/" title="Habari">Habari</a> &nbsp;|&nbsp; <a rel="license, nofollow" href="http://creativecommons.org/licenses/by-nc-sa/3.0/de/"><img width="80" height="15" alt="Creative Commons License" src="http://i.creativecommons.org/l/by-nc-sa/3.0/de/80x15.png" /></a> 2009 - <?php echo date('Y'); ?> <a href="http://underweb.de/" title="Valentin Kotov">Valentin Kotov</a></p>
				</div>
						
			</footer>

		<?php $theme->footer(); ?>

	<?php
	/*** 
	*
	*  In order to see DB profiling information:
	*  1. Insert this line in your config file: define( 'DEBUG', TRUE );
	*  2. Uncomment the followng line
	*
	***/
	// include 'db_profiling.php';
	?>
	
	</body>
</html>
