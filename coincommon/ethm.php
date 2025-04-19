<?php
define('eth_C_APP_ID1',"df85b3aacf9e4bcd9cfed34d2c63a129");
define('eth_C_APP_KEY1',"9fbcc90e2ed011e99e1200163e00073a");
define('eth_C_token_address',"0x1cfdf39b868eb0a1ff11939b632c27926798ecb3");
define('eth_C_GF_WALLET',"0x81deAd59E3A0423bed9ab5869901E41517458c1e");


function eth_newaddressM(){
	$appId = eth_C_APP_ID1;
	$appKey = eth_C_APP_KEY1;
	$bapihost="https://blockchain.phizhub.com/api/create_wallet?size=1";

	$timestamp = time()*1000;
	
	$signature = md5($appKey."_".$timestamp);
	
	$header = array(
	  'http' =>array('header' => 
	   "signature: ".$signature."\r\n" .
	   "timestamp: ".$timestamp."\r\n" .
	   "appid: ".$appId."\r\n" 
	  )
	);
	
	$header = stream_context_create($header);
	$res = file_get_contents($bapihost, 0, $header);
	
	$res = json_decode($res,true);
	
	$resc = array();
	
	if(!empty($res['data']['addresses'][0]['address']) && !empty($res['data']['addresses'][0]['privateKey'])){
		$resc['address'] = $res['data']['addresses'][0]['address'];
		$resc['privateKey'] = $res['data']['addresses'][0]['privateKey'];
		$resc['mnemonic'] = $res['data']['addresses'][0]['mnemonic'];
	}else{
		print_r('请刷新页面，页面加载异常！');exit;
	}
	return $resc;
}

function eth_now_u_newaddress_chkM(){
	
	$list = db ('out_coininfo')->where(['member_id'=>cookie('frcw_uid'),'coin'=>'eth'])->find();
	
	if(!$list){
		$res = eth_newaddressM();
		
		$ures = db('out_coininfo')->insert([
            'member_id' => cookie('frcw_uid'),
            'coin' => 'eth',
            'pck_address' => $res["address"],
			'pck_privateKey' => $res["privateKey"],
			'pck_mnemonic' => $res["mnemonic"]
            ]);
		
		if($ures){
			return true;
		}else{
			print_r('请刷新页面，页面加载异常！');exit;
		}
	}else{
		
		if(empty($list["pck_address"]) || empty($list["pck_privateKey"])){
			
			$res = eth_newaddressM();
			
			
			$ures = db('out_coininfo')->where([
				'id'=>$list['id']
			])->update([
				'pck_address' => $res['address'],
				'pck_privateKey' => $res['privateKey'],
				'pck_mnemonic' => $res["mnemonic"]
			]);
			
			
			if($ures){
				return true;
			}else{
				print_r('请刷新页面，页面加载异常！');exit;
			}
			
			
			
		}else{
			return true;
		}
		
	}
}







function eth_get_token_balanceM($address){
	$appId = eth_C_APP_ID1;
	$appKey = eth_C_APP_KEY1;
	$bapihost="https://blockchain.phizhub.com/api/get_token_balance?token_address=".eth_C_token_address."&address=".$address;

	$timestamp = time()*1000;
	
	$signature = md5($appKey."_".$timestamp);
	
	$header = array(
	  'http' =>array('header' => 
	   "signature: ".$signature."\r\n" .
	   "timestamp: ".$timestamp."\r\n" .
	   "appid: ".$appId."\r\n" 
	  )
	);
	
	$header = stream_context_create($header);
	$res = file_get_contents($bapihost, 0, $header);
	
	$res = json_decode($res,true);
	
	$resc = "";
	
	if(!empty($res['data']['balance'])){
		$resc = $res['data']['balance'];
	}else{
		print_r('请刷新页面，页面加载异常！');exit;
	}
	return $resc;
}

//总钱包转入  $address  钱包地址

function eth_transfer_tokenM($address,$amount){
	$appId = eth_C_APP_ID1;
	$appKey = eth_C_APP_KEY1;
	$bapihost="https://blockchain.phizhub.com/api/transfer_token?token_address=".eth_C_token_address."&to_address=".$address."&amount=".$amount*100;

	$timestamp = time()*1000;
	
	$signature = md5($appKey."_".$timestamp);
	
	$header = array(
	  'http' =>array('header' => 
	   "signature: ".$signature."\r\n" .
	   "timestamp: ".$timestamp."\r\n" .
	   "appid: ".$appId."\r\n" 
	  )
	);
	
	$header = stream_context_create($header);
	$res = file_get_contents($bapihost, 0, $header);
	//print_r($res);exit;
	$res = json_decode($res,true);
	
	$resc = "";
	
	if(!empty($res['data']['tx_hash'])){
		$resc = $res['data']['tx_hash'];
		//先存数据库
		
		
	}else{
		echo "<script>alert('转出失败！');history.go(-1)</script>";exit();
	}
	return $resc;
}

//$address  转入   总钱包
function eth_transfer_tokenMutz($address,$amount){
	$appId = eth_C_APP_ID1;
	$appKey = eth_C_APP_KEY1;
	$bapihost="https://blockchain.phizhub.com/api/transfer_token?token_address=".$address."&to_address=".eth_C_token_address."&amount=".$amount*100;

	$timestamp = time()*1000;
	
	$signature = md5($appKey."_".$timestamp);
	
	$header = array(
	  'http' =>array('header' => 
	   "signature: ".$signature."\r\n" .
	   "timestamp: ".$timestamp."\r\n" .
	   "appid: ".$appId."\r\n" 
	  )
	);
	
	$header = stream_context_create($header);
	$res = file_get_contents($bapihost, 0, $header);
	//print_r($res);exit;
	$res = json_decode($res,true);
	
	$resc = "";
	
	if(!empty($res['data']['tx_hash'])){
		$resc = $res['data']['tx_hash'];
	}else{
		echo "<script>alert('转出失败！');history.go(-1)</script>";exit();
	}
	return $resc;
}





//$faddress 转入  $taddress  钱包地址

function eth_transfer_tokenMp($faddress,$taddress,$amount){
	$appId = eth_C_APP_ID1;
	$appKey = eth_C_APP_KEY1;
	$bapihost="https://blockchain.phizhub.com/api/transfer_token?token_address=".$faddress."&to_address=".$address."&amount=".$amount*100;

	$timestamp = time()*1000;
	
	$signature = md5($appKey."_".$timestamp);
	
	$header = array(
	  'http' =>array('header' => 
	   "signature: ".$signature."\r\n" .
	   "timestamp: ".$timestamp."\r\n" .
	   "appid: ".$appId."\r\n" 
	  )
	);
	
	$header = stream_context_create($header);
	$res = file_get_contents($bapihost, 0, $header);
	//print_r($res);exit;
	$res = json_decode($res,true);
	
	$resc = "";
	
	if(!empty($res['data']['tx_hash'])){
		$resc = $res['data']['tx_hash'];
	}else{
		echo "<script>alert('转出失败！');history.go(-1)</script>";exit();
	}
	return $resc;
}





function eth_get_tx_infoM($tx_hash){
	$appId = eth_C_APP_ID1;
	$appKey = eth_C_APP_KEY1;
	$bapihost="https://blockchain.phizhub.com/api/get_tx_info?tx_hash=".$tx_hash;

	$timestamp = time()*1000;
	
	$signature = md5($appKey."_".$timestamp);
	
	$header = array(
	  'http' =>array('header' => 
	   "signature: ".$signature."\r\n" .
	   "timestamp: ".$timestamp."\r\n" .
	   "appid: ".$appId."\r\n" 
	  )
	);
	
	$header = stream_context_create($header);
	$res = file_get_contents($bapihost, 0, $header);
	//print_r($res);exit;
	$res = json_decode($res,true);
	
	$resc = "";
	
	if(!empty($res['data'])){
		$resc = $res['data']['status'];
	}else{
		print_r('请刷新页面，页面加载异常！');exit;
	}
	return $resc;
}






function eth_get_gas_price(){
	$appId = eth_C_APP_ID1;
	$appKey = eth_C_APP_KEY1;
	$bapihost="https://blockchain.phizhub.com/api/get_gas_price";

	$timestamp = time()*1000;
	
	$signature = md5($appKey."_".$timestamp);
	
	$header = array(
	  'http' =>array('header' => 
	   "signature: ".$signature."\r\n" .
	   "timestamp: ".$timestamp."\r\n" .
	   "appid: ".$appId."\r\n" 
	  )
	);
	
	$header = stream_context_create($header);
	$res = file_get_contents($bapihost, 0, $header);
	//print_r($res);exit;
	
	//{"errno":0,"errmsg":"","data":{"block_time":13.814,"fast":5,"instant":20,"block_number":7320082,"standard":3,"health":true,"slow":2}}
	
	$res = json_decode($res,true);
	
	$resc = "";
	
	if(!empty($res['data'])){
		$resc = $res['data'];
	}else{
		print_r('请刷新页面，页面加载异常！');exit;
	}
	return $resc;
}

?>