<?php
/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 22/03/16
 * Time: 20:41
 */

namespace AppBundle\Handler;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class IssueHandler extends DocumentHandler
{
    public function process( $document, array $parameters, $method = "PUT")
    {


        $uploadedFile = null;

        $form = $this->formFactory->create($this->createDocumentType(), $document, array('method' => $method));

        $files = $this->filesArrayTransformer($_FILES);

        foreach ($files as $file) {
            $uploadedFile = new UploadedFile(
                $file['tmp_name'],
                $file['name'], $file['type'],
                $file['size'], $file['error'],
                $test = false
            );

        }

        $fileArray = array('file' => $uploadedFile);

        dump($uploadedFile);

        array_merge($parameters, $fileArray);


        $form->submit($parameters[$this->documentPrefix()], "PATCH" !== $method);

        if ($form->isValid()) {

            $document = $form->getData();

            if($uploadedFile->getSize()!=0) {

                $document->setFile($uploadedFile->getPathname());
                $document->setFilename($uploadedFile->getClientOriginalName());
                $document->setMimeType($uploadedFile->getMimeType());
            }

            $this->dm->persist($document);
            $this->dm->flush($document);

            return $document;

        }

        throw new InvalidFormException('Invalid submitted data', $form);

    }


    public function filesArrayTransformer($file)
    {

        $keys = array(); // Almacena las claves del array
        $test = array();
        $resultado = array();


        /* Genera el numero de array dependiento de la cantidad de archivos con las claves vacias */
        foreach ($file as $var => $params) {
            $file_count = count(next($params));
            for ($i = 0; $i < $file_count; $i++) {
                foreach (array_keys($params) as $key) {
                    $keys['file_'.$i][$key] = null;
                }
            }
        }

        $resultado = $keys;



        foreach ($file as $var => $params) {


            foreach ($params as $name => $val) {


                $file_count = count($val);

                for ($i=0; $i < $file_count; $i++) {

                    foreach ($val as $row => $value) {


                        $test['file_'.$i][$name] = $value  ;

                        if(!array_key_exists($name, $keys['file_'.$i]) && $keys['file_'.$i][$name] == null){

                            $keys['file_'.$i][$name] = $value;

                        }
                    }

                }
            }
        }

        return $test;
    }

    public function getIssuesByCategory($category)
    {
        return $this->repository->findAllByCategory($category)->toArray();

    }

}