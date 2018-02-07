<?php

class CVM_Vlog_Actions_Compatibility {
	/**
	 * Theme name
	 * @var string
	 */
	private $theme_name;

	/**
	 * CVM_Vlog_Actions_Compatibility constructor.
	 *
	 * @param string $theme_name
	 */
	public function __construct( $theme_name ) {
		$this->theme_name = $theme_name;
		add_filter( 'cvm_theme_support', array( $this, 'theme_support' ) );
		add_filter( 'cvm_video_post_content', array( $this, 'add_url_to_content' ), 10, 3 );
	}

	/**
	 * @param array $themes
	 *
	 * @return array
	 */
	public function theme_support( $themes ) {
		$theme_name = strtolower( $this->theme_name );
		$themes[ $theme_name ] = array(
			'post_type'    => 'post',
			'taxonomy'     => false,
			'tag_taxonomy' => 'post_tag',
			'post_meta'    => array(),
			'post_format'  => 'video',
			'theme_name'   => $this->theme_name,
			'url'          => 'https://themeforest.net/item/vlog-video-blog-magazine-wordpress-theme/15968884/?ref=cboiangiu',
		);

		return $themes;
	}

	/**
	 * @param $post_content
	 * @param $video
	 * @param $theme_import
	 *
	 * @return string
	 */
	public function add_url_to_content( $post_content, $video, $theme_import ) {
		if ( ! $theme_import ) {
			return $post_content;
		}

		$url = cvm_video_url( $video['video_id'] );

		return $post_content . "\n" . $url;
	}
}