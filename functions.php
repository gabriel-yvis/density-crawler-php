<?php

$conteudo = array(
   array('https://www.odontologiacomestetica.com.br/ortognatica-classe-2', 'ortognática classe 2')
);

function checkGZip($url){
   $gzip = file_get_contents($url);
   $gzip = (gzdecode($gzip)!='') ? 'gzip' : 'sem gzip';
   echo $url.' => '.$gzip.'<br />';
}

function getContent($url, $html = false){
   $content = file_get_contents($url);
   $content = (gzdecode($content)!='') ? gzdecode($content) : $content;
   $content = preg_replace('/</', '&lt;', preg_replace('/>/', '&gt;', $content)); // "html entities"
   // exit(var_dump($content));
   $content = mb_strtolower($content, 'UTF-8');
   $content = preg_replace('/[\s+\–\﻿\»\“\”]/', ' ', $content); // se não remover as \n não remove os scripts abaixo
   $content = preg_replace('/<n?o?script(.*?)<\/n?o?script>/', '', $content);
   $content = preg_replace('/<style(.*?)<\/style>/', '', $content);
   $content = $html ? $content : strip_tags($content);
   $content = preg_replace('/[^\w\d\sÀ-ÖØ-öø-ÿ]/', '', $content); //limpando simbolos
   $content = preg_replace('/\s+/', ' ', $content); // removendo espaços continuos
   // $content = htmlentities($content);
   return $content;
}

function getDensity($url, $key){
   // guarando informacoes do conteudo
   $data['url']                  = $url;
   $data['content']              = getContent($url);
   $data['content_words']        = explode(' ', $data['content']);
   $data['content_size']         = count($data['content_words']);
   $data['content_unique_words'] = array_unique($data['content_words']);
   $data['content_unique_size']  = count($data['content_unique_words']);
   // guarando informacoes da keyword
   $data['keyword']              = trim(mb_strtolower($key, 'UTF-8'));
   $data['keyword_size']         = count(explode(' ', $data['keyword']));
   preg_match_all('/'.$data['keyword'].'/', $data['content'], $data['keyword_times']);
   $data['keyword_times']        = count($data['keyword_times'][0]);
   // $data['keyword_density']      = ($data['keyword_times'] * 100) / ($data['content_size'] / $data['keyword_size']);
   $data['keyword_density']      = round(($data['keyword_times'] * 100) / ($data['content_size'] / $data['keyword_size']), 2);
   
   // var_dump($data);
   return $data;
}

function printDensity($data){
   echo '<br />URL: '.$data['url'];
   // echo '<br />GZIP: '.$data['gzip']; // editar getContent para ele retornar array com conteudo e gzip
   echo '<br />Keyword: '.$data['keyword'];
   echo '<br />Tamanho da Keyword: '.$data['keyword_size'];
   echo '<br />Repetições da Keyword: '.$data['keyword_times'];
   echo '<br />Total de Palavras: '.$data['content_size'];
   echo '<br />Palavras Únicas: '.$data['content_unique_size'];
   echo '<br />Densidade da Keyword: '.$data['keyword_density'].'%';
   // echo '<hr />'.$data['content'];
   echo '<hr />';
}

function printCSVDensity($data){
   echo $data['url'].', '.$data['keyword'].', '.$data['keyword_density'].'<br />';
   // echo '<hr />'.$data['content'];
}