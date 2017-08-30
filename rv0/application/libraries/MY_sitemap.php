<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 *  Sitemap Class
 *  Copyright (c) 2008 - 2013 All Rights Reserved.
 *
 *  Props to Mike's Imagination for the approach
 *  http://www.mikesimagination.net/blog/post/29-Aug-12/Codeigniter-auto-XML-sitemap
 *
 *  Generates sitemap
 */
 
class MY_sitemap {
 
    // CI instance property
  protected $ci;
 
  /**
   *  Constructor
   */
  public function __construct()
  {
      // Get the CI instance by reference to make the CI superobject available in this library
    $this->ci =& get_instance();
  }
 
  /**
   *  Generate sitemap
   */
  public function create()
  {
    // Begin assembling the sitemap starting with the header
    $sitemap = "<\x3Fxml version=\"1.0\" encoding=\"UTF-8\"\x3F>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
 
    // Add static pages not in database to sitemap
    // Home page
    $sitemap .= "\t<url>\n\t\t<loc>" . site_url() . "</loc>\n\t</url>\n\n";
    // About page
    $sitemap .= "\t<url>\n\t\t<loc>" . site_url('main/about') . "</loc>\n\t</url>\n\n";
 
     // Get all recipes (records) from database. Load (or autoload) the model
    $this->ci->load->model('recipe_model');
    $recipes = $this->ci->recipe_model->find_where();
 
    // Add each recipe URL to the sitemap while enclosing the URL in the XML <url> tags
    // Since my database tracks the last updated date, I am including that as well - but with the date only in YYYY-MM-DD format
    foreach($recipes['results'] as $recipe)
    {
       $sitemap .= "\t<url>\n\t\t<loc>" . site_url('recipe/show/' . $recipe->get_nice_url()) . "</loc>\n";
       $sitemap .= "\t\t<lastmod>" . date('Y-m-y' ,strtotime($recipe->updated_date)) . "</lastmod>\n \t</url>\n\n";
    }
 
    // If you have other records you wish to include, get those and continue to append URL's to the sitemap.
 
    // Close with the footer
    $sitemap .= "</urlset>\n";
 
    // Write the sitemap string to file. Make sure you have permissions to write to this file.
    $file = fopen('sitemap.xml', 'w');
    fwrite($file, $sitemap);
    fclose($file);
 
    // If this is the production instance, attempt to update Google with the new sitemap.
    // (The instance is set in the index.php file)
    if(ENVIRONMENT === 'production')
    {
      // Ping Google via http request with the encoded sitemap URL
      $sitemap_url = site_url('sitemap.xml');
      $google_url = "http://www.google.com/webmasters/tools/ping?sitemap=".urlencode($sitemap_url);
 
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,2);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      curl_setopt ($ch, CURLOPT_URL, $google_url);
      $response = curl_exec($ch);
      $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 
      // Log error if update fails
      if (substr($http_status, 0, 1) != 2)
      {
        log_message('error', 'Ping Google with updated sitemap failed. Status: ' . $http_status);
        log_message('error', '    ' . $google_url);
      }
    }
 
    return;
  }
}
 
// End of file MY_sitemap
// Location: ./application/libraries/MY_sitemap.php