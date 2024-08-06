package com.example.practical7;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
//RVer8JDaFyyr06Ld
public class MainActivity2 extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);

        TextView tv1 = new TextView(this);
        tv1.setText("Name: ");
        tv1.setTextSize(24);
        EditText et1 = new EditText(this);
        Button bt1 = new Button(this);
        bt1.setText("submit");
        LinearLayout ll = new LinearLayout(this);
        ll.setOrientation(LinearLayout.VERTICAL);
        ll.addView(tv1);
        ll.addView(et1);
        ll.addView(bt1);
        setContentView(ll);

        bt1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                MyThread connectThread = new MyThread(et1.getText().toString());
                connectThread.start();
            }
        });
    }

    private class MyThread extends Thread{
        private String myName;
        public MyThread(String name){
            this.myName = name;
        }
        public void run(){
            try {
                //URL url = new URL("https://api.nationalize.io?name=" + myName);//Q2
                //Q3
//                URL url = new URL("https://qjhxwllzhclwsqllxatr.supabase.co/rest/v1/Student?" +
//                        "id=eq."+ myName+"&select=*" );
                //Q4
                JSONObject jsonObject = new JSONObject();
                jsonObject.put("name", myName);
                URL url = new URL("https://qjhxwllzhclwsqllxatr.supabase.co/rest/v1/Student");
                Log.i("MainActivity2", url.toString());
                HttpURLConnection hc = (HttpURLConnection) url.openConnection();
                hc.setRequestProperty("apikey",getString(R.string.apiKey));
                hc.setRequestProperty("Authorization", "Bearer " + getString(R.string.apiKey));
                //Q4
                hc.setRequestProperty("Content-Type","application/json");
                hc.setRequestProperty("Prefer", "return=minimal");
                hc.setDoOutput(true);
                OutputStream output = hc.getOutputStream();
                output.write(jsonObject.toString().getBytes());
                output.flush();
                InputStream input = hc.getInputStream();
                String result = readStream(input);
                if (hc.getResponseCode() == 200){
                    Log.i("MainActivity2", "HTTP connect success");
                    Log.i("MainActivity2", result);
                    Intent intent = new Intent(MainActivity2.this, SuccessActivity.class);
                    intent.putExtra("response", result);
                }
                else if(hc.getResponseCode() == 201){
                    Log.i("MainActivity2", "Success Insert");
                }
                else {
                    Log.i("MainActivity2", "Respond Code: "+ hc.getResponseCode());
                }
                input.close();
                output.close();
            } catch (MalformedURLException e) {
                throw new RuntimeException(e);
            } catch (IOException e) {
                throw new RuntimeException(e);
            } catch (JSONException e) {
                throw new RuntimeException(e);
            }

        }
    }
    private String readStream(InputStream is) {
        try {
            ByteArrayOutputStream bo = new ByteArrayOutputStream();
            int i = is.read();
            while (i != -1) {
                bo.write(i);
                i = is.read();
            }
            return bo.toString();
        } catch (IOException e) {
            return "";
        }
    }
}
