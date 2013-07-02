<?php
class Dropdown_Menu{

	
	var $CI;
	
	function __construct()
	{
		$this->CI =& get_instance();		
		$this->CI->load->model('Category_model');
		$this->CI->load->model('Product_model');
				
	}
	
	public function get_all_categories()
    {	
    		
			$sorted_array['A'] = array();
			$sorted_array['B'] = array();
			$sorted_array['C'] = array();
			$sorted_array['D'] = array();
			$sorted_array['E'] = array();
			$sorted_array['F'] = array();
			$sorted_array['G'] = array();
			$sorted_array['H'] = array();
			$sorted_array['J'] = array();
			$sorted_array['K'] = array();
			$sorted_array['L'] = array();
			$sorted_array['M'] = array();
			$sorted_array['N'] = array();
			$sorted_array['O'] = array();
			$sorted_array['P'] = array();
			$sorted_array['Q'] = array();
			$sorted_array['R'] = array();
			$sorted_array['S'] = array();
			$sorted_array['T'] = array();
			$sorted_array['U'] = array();
			$sorted_array['V'] = array();
			$sorted_array['W'] = array();
			$sorted_array['X'] = array();
			$sorted_array['Y'] = array();
			$sorted_array['Z'] = array();
			
			$data['category'] =$this->CI->Category_model->get_categories_dropdown();
			foreach($data['category'] as $category)
			{
				
				$category['count'] = $this->CI->Product_model->count_products($category['id']);
				$first_letter = strtoupper(substr($category['name'], 0, 1));
				if($first_letter == 'A')
				{
					$sorted_array['A'][] = $category;
				}
				else if($first_letter == 'B')
				{
					$sorted_array['B'][] = $category;
				}
				else if($first_letter == 'C')
				{
					$sorted_array['C'][] = $category;
				}
				else if($first_letter == 'D')
				{
					$sorted_array['D'][] = $category;
				}
				else if($first_letter == 'E')
				{
					$sorted_array['E'][] = $category;
				}
				else if($first_letter == 'F')
				{
					$sorted_array['F'][] = $category;
				}
				else if($first_letter == 'G')
				{
					$sorted_array['G'][] = $category;
				}
				else if($first_letter == 'H')
				{
					$sorted_array['H'][] = $category;
				}
				else if($first_letter == 'I')
				{
					$sorted_array['I'][] = $category;
				}
				else if($first_letter == 'J')
				{
					$sorted_array['J'][] = $category;
				}
				else if($first_letter == 'K')
				{
					$sorted_array['K'][] = $category;
				}
				else if($first_letter == 'L')
				{
					$sorted_array['L'][] = $category;
				}
				else if($first_letter == 'M')
				{
					$sorted_array['M'][] = $category;
				}
				else if($first_letter == 'N')
				{
					$sorted_array['N'][] = $category;
				}
				else if($first_letter == 'O')
				{
					$sorted_array['O'][] = $category;
				}
				else if($first_letter == 'P')
				{
					$sorted_array['P'][] = $category;
				}
				else if($first_letter == 'Q')
				{
					$sorted_array['Q'][] = $category;
				}
				else if($first_letter == 'R')
				{
					$sorted_array['R'][] = $category;
				}
				else if($first_letter == 'S')
				{
					$sorted_array['S'][] = $category;
				}
				else if($first_letter == 'T')
				{
					$sorted_array['T'][] = $category;
				}
				else if($first_letter == 'U')
				{
					$sorted_array['U'][] = $category;
				}
				else if($first_letter == 'V')
				{
					$sorted_array['V'][] = $category;
				}
				else if($first_letter == 'W')
				{
					$sorted_array['W'][] = $category;
				}
				else if($first_letter == 'X')
				{
					$sorted_array['X'][] = $category;
				}
				else if($first_letter == 'Y')
				{
					$sorted_array['Y'][] = $category;
				}
				else if($first_letter == 'Z')
				{
					$sorted_array['Z'][] = $category;
				}
				
			}
			//$this->CI->show->pe($sorted_array);
			return $sorted_array;
			
	}
}
?>