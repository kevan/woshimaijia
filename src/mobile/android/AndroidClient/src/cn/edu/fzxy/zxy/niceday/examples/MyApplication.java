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
package cn.edu.fzxy.zxy.niceday.examples;

import cn.edu.fzxy.zxy.niceday.DefaultThreadPool;
import android.app.Application;
import android.util.Log;

/**
 * 
 * @author meiyitian
 *
 */
public class MyApplication extends Application {
	
	/* (non-Javadoc)
	 * @see android.app.Application#onCreate()
	 */
	@Override
	public void onCreate() {
	
		super.onCreate();
	}
	
	 /* (non-Javadoc) ����ʱ�䣬ֻ�е�����ϵͳ���ڴ洦�ڵ�λ��ʱ��ų���ִ�д˷���
	 * @see android.app.Application#onLowMemory()
	 */
	@Override
	public void onLowMemory() {
		/**
		 * ���ڴ��ʱ�������ͷ������̺߳���Դ 
		 * 
		 * PS:���ﲻһ��ÿ��������
		 */
		DefaultThreadPool.shutdown();
		Log.i(MyApplication.class.getName(), "MyApplication  onError  onLowMemory");
		super.onLowMemory();
	}
	
	/* (non-Javadoc)
	 * @see android.app.Application#onTerminate()
	 */
	@Override
	public void onTerminate() {
		/**
		 * ϵͳ�˳���ʱ�������ͷ������̺߳���Դ
		 * PS:���ﲻһ����������
		 */
		DefaultThreadPool.shutdown();
		Log.i(MyApplication.class.getName(), "MyApplication  onError  onTerminate");
		super.onTerminate();
	}
	
}

