package stp.noida.hp.com.memorygame;

import android.app.ProgressDialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.Hashtable;
import java.util.Map;

public class signup extends AppCompatActivity {
String user="";
   // String UPLOAD_URL="http://10.5.58.21/IET-Hackathon/ved/index.php";
    String UPLOAD_URL="http://ved.pe.hu/index.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);
        Button b1=(Button)findViewById(R.id.button);
      //  TextView t=(TextView)findViewById(R.id.editText);

        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                TextView t=(TextView)findViewById(R.id.editText4);
                TextView t1=(TextView)findViewById(R.id.editText5);
                if((t.getText().toString().trim()).equals(t1.getText().toString().trim())){
                    uploadImage();
                }
                else{
                    Toast.makeText(getApplicationContext()," Password Creditials ",Toast.LENGTH_LONG);
                }
            }
        });
    }
    private void uploadImage(){
        //Showing the progress dialog
        final ProgressDialog loading = ProgressDialog.show(signup.this, "Uploading...", "Please wait...", false, false);
        StringRequest stringRequest = new StringRequest(Request.Method.POST, UPLOAD_URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String s) {
                        //Disimissing the progress dialog
                        loading.dismiss();
                        System.out.println(s+".........................................");
                        if(s.trim().equals("success"))
                        {
                            startActivity(new Intent(signup.this,signinwith.class));
                            Toast.makeText(getApplicationContext(),"Successfully Registered",Toast.LENGTH_LONG);
                            finish();
                        }
                        else{}
                        //  Toast.makeText(MainGame.this, s, Toast.LENGTH_LONG).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {
                        //Dismissing the progress dialog
                        loading.dismiss();

                        //Showing toast   + volleyError.getMessage().toString()
                        Toast.makeText(signup.this,"Error"+volleyError, Toast.LENGTH_LONG).show();
                    }
                }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                //Converting Bitmap to String


                //Getting Image Name
                TextView t=(TextView)findViewById(R.id.editText);
                String lev=  "";
                lev=t.getText().toString();
                TextView t1=(TextView)findViewById(R.id.editText5);
                String pass= t1.getText().toString();
                //  String pass=pass1.getText().toString().trim();
                //Creating parameters
                Map<String,String> params = new Hashtable<String, String>();
                //Adding paramet
                params.put("username",lev.trim());
                params.put("password",pass.trim());

                params.put("task","signup");

                //returning parameters
                return params;
            }
        };

        //Creating a Request Queue
        RequestQueue requestQueue = Volley.newRequestQueue(this);

        //Adding request to the queue
        requestQueue.add(stringRequest);
    }
}
