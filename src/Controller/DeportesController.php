<?php
/**
 * Created by PhpStorm.
 * User: imagina
 * Date: 13/02/18
 * Time: 11:48
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DeportesController extends Controller

{
    /**
     * @Route("/deportes/")
     */
    public function inicio()
    {
        return new Response('Mi página de deportes!');
    }

    /**
     * @Route("/deportes/{seccion}/{pagina}", name="lista_paginas",
     *      requirements={"pagina"="\d+"},
     *      defaults={"seccion":"tenis"})
     */
    public function lista($pagina = 1, $seccion)
    {
        //Simulamos una baser de datos de deportes
        $deportes=["futbol", "tenis","rugby"];

        //Si el deporte que buscamos no se encuentra lanzamos la
        //excepcion 404 deporte no encontrado
        if(!in_array($seccion,$deportes)){
            throw $this->createNotFoundException('Error 404 este deporte no esta en nuestra Base de Datos');
        }

        return new Response(sprintf(
            'Deportes seccion: seccion %s, listado de noticias pagina %s',
            $seccion, $pagina));
    }



    /**
     * @Route("/deportes/{seccion}/{slug} ",
     * defaults={"seccion":"tenis"})
     */
    public function noticia($slug, $seccion)
    {

        return new Response(sprintf(
            'Noticia de %s, con url dinamica=%s',
            $seccion, $slug));
    }



    /**
     * @Route(
     *     "/deportes/{_idioma}/{fecha}/{seccion}/{equipo}/{pagina}",
     *     defaults={"slug": "1","_formato":"html","pagina":"1"},
     *     requirements={
     *         "_idioma": "es|en",
     *         "_formato": "html|json|xml",
     *         "fecha": "[\d+]{8}",
     *         "pagina"="\d+"
     *     }
     * )
     */
    public function rutaAvanzadaListado($_idioma,$fecha, $seccion, $equipo, $pagina)
    {
        return new Response(sprintf(
            'Listado de noticias  en idioma=%s,
             fehca=%s,deporte=%s,equipo=%s, página=%s ',
            $_idioma, $fecha, $seccion, $equipo, $pagina));
    }



    /**
     * @Route(
     *     "/deportes/{_idioma}/{fecha}/{seccion}/{equipo}/{slug}.{_formato}",
     *     defaults={"slug": "1","_formato":"html"},
     *     requirements={
     *         "_idioma": "es|en",
     *         "_formato": "html|json|xml",
     *          "fecha": "[\d+]{8}"
     *     }
     * )
     */
    public function rutaAvanzada($_idioma,$fecha, $seccion, $equipo, $slug)
    {
        return new Response(sprintf(
            'Mi noticia en idioma=%s,
             fehca=%s,deporte=%s,equipo=%s, noticia=%s ',
            $_idioma, $fecha, $seccion, $equipo, $slug));
    }


}




