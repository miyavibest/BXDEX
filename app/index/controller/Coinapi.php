<?php
namespace app\index\controller;
use app\common\controller\Home;

class Coinapi extends Home
{
    public function _initialize()
    {
        parent::_initialize();
    }
	
	

	
	


    public function register1()
    {
    	
		$postdata = $_POST;
		
		$postdataj = json_encode($postdata,true);
		/**
		$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
		fwrite($myfile, $postdataj);
		fclose($myfile);
		*/
		
		
		if(!empty($postdata['tx_hash']) && !empty($postdata['request_key']) && !empty($postdata['to_address']) && !empty($postdata['amount']) && $postdata['amount']>0){
			
			
			if($postdata['request_key'] != "99e0cc32c1738dd0d89753c7ecc7989c"){
				exit("");
			}
			
			
			$model = new \core\lib\model\model();
			
			//transactioncallback          transactionjson
			
			$transactioncallback = db ('out_transactioncallback')->where(['tx_hash'=>$postdata['tx_hash'],'coin'=>'eth'])->find();
			
			if($transactioncallback){
				
				$timev = time();
				$member_id = "";
				$oid = "";
				
				
				$out_coininfoc = db ('out_coininfo')->where(['pck_address'=>$postdata['to_address'],'coin'=>'eth'])->find();
				if($out_coininfoc){
					$memberc = db('member')->where(['id'=>$out_coininfoc['member_id']])->find();
					if($memberc){
						$member_id = $memberc['id'];
						
						//+money
						$num = $postdata['amount']/100;

						$user_coin = db('coin')->where('member_id',$memberc['id'])->find();
						$updatecoin['eth']  = $user_coin['eth'] + $res['num'];
						db('coin')->where('member_id',$memberc['id'])->update($updatecoin);
						
						db('coin_record')->insert([
							'phone' => $memberc['phone'],
							'coin' => 'eth',
							'num' => $num,
							'type' => '充币通过',
							'inout' => 'in',
							'add_time'=>$timev
							]);
						
						$oid = db('tijiao')->insert([
							'name' => $memberc['phone'],
							'type' => 'eth',
							'num' => $num,
							'dizhi' => $postdata['to_address'],
							'remark' => '',
							'add_time'=>$timev,
							'status'=>1
							]);
					}
				}
				
				
				//通过tx_hash去同步转出表手续费-----------
				
				
				
				
				
				
				
				
				db('out_transactioncallback')->insert([
					'member_id' => $member_id
					'coin' => 'eth',
					'tx_hash' => $postdata['tx_hash'],
					'transactionjson' => $postdataj,
					'to_address' => $postdata['to_address'],
					'from' => $postdata['from'],
					'amount' => $postdata['amount'],
					'time' => $timev,
					'oid' => $oid
					]);
					
			}
		}
		
		echo "SUCCESS";
		
		
		
    }

}