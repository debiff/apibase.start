<?php
/**
 * Created by PhpStorm.
 * User: simone
 * Date: 26/06/15
 * Time: 14.48
 */

namespace SB\UserBundle\Controller;
use JMS\Serializer\Exception\RuntimeException;
use JMS\Serializer\SerializationContext;
use SB\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends Controller{
    protected function serialize($data, $format = 'json')
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);
       return $this->get('jms_serializer')->serialize($data, $format, $context);
    }
    protected function deserialize( Request $request,$class, $format = 'json', User $user)
    {
        $serializer=$this->get('jms_serializer');
        try {
            $user=$serializer->deserialize($request->getContent(), $class, $format);
            //$entity = $serializer->deserialize($request->getContent(), $class, $format);
        }catch (RuntimeException $e) {
            $error[]=array(array('message'=>$e->getMessage()));
            return new Response($this->serialize($error),500);
        }
        //return $entity;
        return $user;
    }
    protected function validation($entity)
    {
        $validator = $this->get('validator');
        $errors=$validator->validate($entity);
        $response=array();
        foreach($errors as $key=>$value)
            $response[]=array('field'=>$value->getPropertyPath(), 'message'=>$value->getMessage());

        return $response;
    }



}