<?php
            //
            
			$json = array();
			$i = 0;
            foreach($tours as $tour)
            {
            	$item = array();
            	$item["image"] 	= $imgUrl = "/hu/images/" . $tour["pic_file"];
            	$item["route"] 	= trim($tour["route"]);
         		$item["name"] 	= $tour["name"];
         		$item['stations'] = $tour["stations"];
                $item["price_adult"] = $tour['minPriceAdult'];
                $item["price_child"] = $tour["minPriceChild"];
                $item['price_group'] = $tour["minPriceChild"];
                
            	$item["month"] = array();
            	$item["month"][0]["name"] = $month0;
            	$item["month"][0]["tours"] = $tour['month0']; 
            	
            	$item["month"][1]["name"] = $month1;
            	$item["month"][1]["tours"] = $tour['month1'];
                   
                $item["month"][2]["name"] = $month2;
                $item["month"][2]["tours"] = $tour['month2'];
               
                $item["month"][3]["name"] = $month3;
                $item['month'][3]['tours'] = $tour['month3'];

                
                 
                $json[$i] =  $item;
                $i++;
            }
            
            echo json_encode($json);
/* EOF */