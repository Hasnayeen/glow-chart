<?php

$jsObject = json_decode('{
    "onDatasetHover": {
          "highlightDataSeries": false
      },
      "x": {
          "show": true,
          "format": "dd MMM",
          "formatter": null
      },
      "y": {
          "formatter": null,
          "title": {
              "formatter": null
          }
      },
      "z": {
          "formatter": null,
          "title": "Size: "
      },
      "marker": {
          "show": true
      },
      "items": {
         "display": "flex"
      },
      "fixed": {
          "enabled": false,
          "position": "topRight",
          "offsetX": 0,
          "offsetY": 0
      }
}', true);
var_dump($jsObject);

function convertJsObjectToPhpClass(string $className, array $jsObject, string $fileName): void
{
    $phpClass = "<?php\n\nclass $className\n{\n";
    $phpNestedClasses = '';

    foreach ($jsObject as $key => $value) {
        if (is_array($value)) {
            // Handle nested objects
            $nestedClassName = ucfirst($key);
            $phpNestedClasses .= convertJsObjectToPhpClass($nestedClassName, $value, $nestedClassName . '.php');
            $phpClass .= "    public $nestedClassName $" . lcfirst($key) . ";\n";

            $phpClass .= "\n    public function $key($nestedClassName $" . lcfirst($key) . "): self\n    {\n";
            $phpClass .= '        $this->$' . lcfirst($key) . ' = $' . lcfirst($key) . ";\n\n";
            $phpClass .= "        return \$this;\n    }\n\n";
        } else {
            // Handle properties
            $phpClass .= '    public $' . lcfirst($key) . " = $value;\n";

            $phpClass .= "\n    public function $key(" . gettype($value) . ' $' . lcfirst($key) . "): self\n    {\n";
            $phpClass .= '        $this->$' . lcfirst($key) . ' = $' . lcfirst($key) . ";\n\n";
            $phpClass .= "        return \$this;\n    }\n\n";
        }
    }

    $phpClass .= "}\n\n";
    $phpCode = $phpClass . $phpNestedClasses;

    file_put_contents($fileName, $phpCode);
}

convertJsObjectToPhpClass('Bubble', $jsObject, 'Bubble.php');
