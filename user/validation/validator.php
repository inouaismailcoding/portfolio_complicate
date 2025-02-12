<?php 
namespace User\validation;


class validator 
{
    private $data;
    private $errors;

    public function __construct(array $data)
    {
        $this->data=$data;
    }

    public function validate(array $rules):?array
    {
        foreach($rules as $name=>$rulesArray)
        {
            if(array_key_exists($name,$this->data))
            {
                foreach($rulesArray as $rule)
                {
                    switch($rule){
                        case 'required':
                            $this->required($name,$this->data[$name]);
                            break;
                        case substr($rule,0,3)=='min':
                            $this->min($name,$this->data[$name],$rule);
                            break;
                        default:
                            break;
                    }
                }
            }
        }
       return $this->getErrors();
    }

    private function required(string $name,string $value)
    {
        $value=trim($value);
        if(!isset($value) || is_null($value) || empty($value))
        {
            $this->errors[$name][]="{$name} est réquis. ";
        }
    }

    private function min(string $name,string $value,string $rule)
    {
        preg_match_all("/(\d+)/",$rule,$matches);
        $limit=(int)$matches[0][0];

        if(strlen($value)<$limit)
        {
            $this->errors[$name][]= "{$name} doit contenir un minimum de {$limit} caracteres";
        }
    }

    private function getErrors():?array
    {
        return $this->errors;
    }
}