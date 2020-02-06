<?php

namespace OrlandoLibardi\PageBuildCms\app;
use File;
use Log;
use OrlandoLibardi\PageBuildCms\app\Page;

class ServicePage
{   
    /**
     * Lê o arquivo de configuração e retorna o caminho para pasta paginas
     * @return Config\Pages\page_path
     */
    public static function getPagePath(){
        return config('pages.page_path');
    }
    /**
     * Lê o arquivo de configuração e retorna o caminho para temporario pasta paginas
     * @return Config\Pages\page_path_temp
     */
    public static function getPagePathTemp(){
        return config('pages.page_path_temp');
    }
    /**
     * Lê o arquivo de configuração e retorna a extensão de arquivo para páginas
     * @return Config\Pages\page_extension
     */
    public static function getPageExtension(){
        return config('pages.page_extension');
    }
    /**
    * Retorna o caminho para o arquivo de rotas dinâmicas de páginas
    * @return string 
    */
    public static function getRouteFileName(){
        return __DIR__ . '/../routes/web-dynamic.php';
    }
    /**
     * Abre o arquivo de rotas e retorna ele mesmo
     * @return string
     */
    public static function openFileRoute(){
        return File::get( self::getRouteFileName() );
    }
    /**
     * Salva o arquivo na pasta 
     * @return void
     */
    public static function saveFileRoute( $content ){
        return File::put( self::getRouteFileName(), $content );
    }
    /**
     * String de modelo para Rotas
     * @return string
     */
    public static function modelRoute( $alias ){
        
        $route_  = 'Route::get("' . $alias . '/{extra?}", "OrlandoLibardi\PageBuildCms\app\Http\Controllers\PageShowController@show")' . "\n";
        $route_ .= '->where("extra", "([A-Za-z0-9\-\/]+)")' . "\n";
        $route_ .= '->middleware("web");' . "\n";
        return $route_;
    } 

    /**
     * Lê os arquivos disponíveis para serem usados como modelo
     * @return array 
    */
    public static function getTemplates()
    {
        $files = File::files(self::getPagePath());
        $return = [];
        foreach($files as $f){
            $fp = pathinfo($f);
            if(substr_count($fp['filename'], ".blade") > 0 ){
                $name = str_replace(".blade", "", $fp['filename']);
                $return[$name] = $name;
            }
        }
        return $return;
    }
    /**
     * Prepara um arquivo modelo para edição
     * @return $file
     */
    public static function prepareFile( $file )
    {
       
    }

    /**
    * Confirma se o arquivo existe caso existir gera o arquivo editavel e responde
    *
    * @param  $template
    * @return string $url
    */
    public static function postCreator($template)
    {
            
    }
    /**
    * Atualiza o template removendo os elementos removidos pelo usuário
    * @param string $file, $content, $titulo, $atualAlias = false
    * @return boolen
    */
    public static function destroyElementsTemplate($file, $content, $titulo, $atualAlias = false)
    {
        
    }
    /**
     * Verifica se existe um registro com mesmo slug caso sim adiciona um indice ao final e verifica de novo
     * @param $alias, $count
     * @return $alias
     */
    public static function checkAlias($alias, $count=0)
    {
        $alias = ($count > 0) ? $alias.'-'.$count : $alias;
        $page = Page::where('alias', $alias)->get();        
        if(count($page) > 0)
            return self::checkAlias($alias, $count+1);

        return $alias;
    }
    /**
     * Cria um vetor com os itens a serem tratados
     * @param array $contents
     * @return array $return 
     */
     public static function getReplaces($contents)
     {        
        $return = [];
        foreach ($contents as $value) {
            $return[$value->id] = $value->content;
        }
        return  $return;
     } 
     /**
      * Cria um vetor com os indices a serem tratados
      * @param array $contents
      * @return array $return 
      */
     public static function getIds($contents)
     {        
        $return = [];
        foreach ($contents as $value) 
        {
            $return[] = $value->id;
        }
        return  $return;
     } 
     /**
      * Cria a rota da página
      * @return void
      */
     public static function createRoutePage($alias)
     {
        $obj = self::modelRoute($alias);
        
        $contentes = self::openFileRoute();

        if ( substr_count( $contentes, $obj ) == 0 ) {
            $contentes .= "\n" . $obj;
            self::saveFileRoute( $contentes );
        }   
        return true;     
     }  
     /**
      * Atualiza o status da página
      * @param int $id, int $status 
      * @return void
      */
    public static function updateStatus($id, $status)
    {
        $new_status = ( $status == 0 ) ? 1 : 0 ;
        Page::find($id)
            ->update([
                'status' => $new_status
            ]);
        return true;    
    }  
    /**
     * Deleta uma página
     * @param array $ids
     */
    public static function deletePage($ids){
        $ids = json_decode($ids);
        foreach($ids as $id){
            if(is_numeric($id)){
                $page =  Page::find($id)->delete();
            }
        }
    } 
    /**
     * Apaga um arquivo de template
     * @return void
     */
    public static function deleteTemplate($alias){
       File::delete(self::getPagePath() . $alias . self::getPageExtension());
    }
    /**
     * Apaga uma rota de página
     * @param string $alias
     */
    public static function deleteRoute($alias){

        $obj = self::modelRoute($alias);
        
        $contentes = self::openFileRoute();

        if ( substr_count( $contentes, $obj ) > 0 ) {
            $contentes = str_replace($obj, "", $contentes);
            self::saveFileRoute( $contentes );
        }        
    }


}