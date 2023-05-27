<?php

require_once 'BaseController.php';
require_once PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'CoachModel.php';

class CoachController extends BaseController
{
    /** 
     * "/coach/list" Endpoint - lista de entrenadores
     */
    public function listAction($name = [''])
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $name = str_replace('name=', '', $name[0]);
                $coachModel = new CoachModel();
                $arrCoachs = $coachModel->getCoaches($name);
                $responseData = json_encode($arrCoachs);
            } catch (\Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    
    /** 
     * "/coach/delete" Endpoint - eliminar un usuario
     */
    public function deleteAction($values)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $id = intval(str_replace('id=', '', $values[0]));
                $coachModel = new CoachModel();
                $deleteResult = $coachModel->deleteCoach($id);
                $responseData = json_encode($deleteResult);
            } catch (\Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
