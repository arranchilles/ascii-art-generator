<?php

namespace App\Classes\Files;
use App\Classes\Exceptions;
use App\Classes\Exceptions\FileNotFound;
use Exception;

class File {
	
	protected string $path;

	protected string $type;

	function __construct(string $file_path){
		
		if(!is_file($file_path)){
			throw new FileNotFound("file not found at {$file_path}");
		}
		$this->path = $file_path;
		$this->set_file_type();
	}

	protected function set_file_type(): void{
		$file_info = pathinfo($this->path);
		if(empty($file_info["extension"])){
			throw new Exception("The file {$this->path}");
		}
		$this->type = $file_info["extension"];
	}

	public function get_type(): string{
		return $this->type;	
	}

	public function get_path(): string{
		return $this->path;
	}

	protected function open($permission){
		return fopen($this->path, $permission);
	}

	protected function close($file_resource){
		fclose($file_resource);
	}

	protected function create_new_file(string $path, string $content=""): void{
		$file_resource = fopen($path, "w+");
		fwrite($file_resource, $content);
		fclose($file_resource);
		return;

	}
}
