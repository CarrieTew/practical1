package com.example.practical7;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class SuccessActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_success);

        Intent intent = getIntent();
        TextView tv =new TextView(this);
        String result;
        try {
            JSONArray jsonArray = new JSONArray(intent.getStringExtra("response"));
            result = "Name  Programme     Age \n";
            JSONObject jsonObject = jsonArray.getJSONObject(0);
            result = result + jsonObject.get("name").toString() + "          " +
                    jsonObject.get("programme").toString() +  "          " +
                    jsonObject.get("age").toString() +  "          ";
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }
        tv.setText(result);
        setContentView(tv);
    }
}
