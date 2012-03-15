
/*
 * Copyright 2011 meiyitian
 * Blog  :http://www.cnblogs.com/meiyitian
 * Email :haoqqemail@qq.com
 * Client for �������Project ��http://code.google.com/p/woshimaijia/
 * Client for �������Website ��http://woshimaijia.com/
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
*/

package cn.edu.fzxy.zxy.niceday;

import java.io.Serializable;

import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpUriRequest;
/**
 * Ŀ�꣺
 * 1����ȫ����
 * 2����Ч
 * 3�����á��׿���
 * 4��activityֹͣ��ֹͣ��activity���õ��̡߳�
 * 5������ڴ棬���ڴ������ʱ���Զ��������գ�������Դ ���������˳�֮����ֹ�̳߳�
 * @author meiyitian
 *
 */
public class BaseRequest  implements   Runnable, Serializable {
	//static HttpClient httpClient = null;
	HttpUriRequest request = null;
	

	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	protected ParseHandler handler = null;
	protected String url = null;
	/**
	 * default is 5 ,to set .
	 */
	protected int connectTimeout = 5;
	/**
	 * default is 5 ,to set .
	 */
	protected int readTimeout = 5;
	protected RequestResultCallback requestCallback = null;
	
	
	@Override
	public void run() {
		
	}
	
	protected void setConnectTimeout(int connectTimeout) {
		this.connectTimeout = connectTimeout;
	}
	
	protected void setReadTimeout(int readTimeout) {
		this.readTimeout = readTimeout;
	}
	
	public HttpUriRequest getRequest() {
		return request;
	}
	
}
