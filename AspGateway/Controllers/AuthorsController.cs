using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using AspGateway.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace AspGateway.Controllers
{
    [ApiController]
    [Route("[controller]")]
    public class AuthorsController : ControllerBase
    {
    

        [HttpGet]
        public  string Get()
        {
            HttpClient client = new HttpClient();    
            client.BaseAddress = new Uri("http://localhost/LumenMicroservices/AuthorsApi/public/");     
            HttpResponseMessage response = client.GetAsync("authors").Result;  // Blocking call!  
            var authors =  response.Content.ReadAsStringAsync().Result;   
            return  authors;

        }

        [HttpGet("{id}")]
        public  string Get(int id)
        {
            HttpClient client = new HttpClient();    
            client.BaseAddress = new Uri("http://localhost/LumenMicroservices/AuthorsApi/public/");     
            HttpResponseMessage response = client.GetAsync($"authors/{id}").Result;  // Blocking call!  
            var authors =  response.Content.ReadAsStringAsync().Result;   
            return  authors;

        }

        [HttpPost]
        public async Task<ActionResult> PostAsync([FromForm] Author author)      
        {


            var client = new HttpClient();

            client.BaseAddress = new Uri("http://localhost/LumenMicroservices/AuthorsApi/public/");
            var content = new FormUrlEncodedContent(new[]
            {
                new KeyValuePair<string, string>("name", "sheriff"),
                new KeyValuePair<string, string>("country", "egypt"),
                new KeyValuePair<string, string>("gender", "male"),
            });


            var result = await client.PostAsync("authors", content);
            string resultContent = await result.Content.ReadAsStringAsync();
            return Ok(new { resultContent, content });

        }
    }
}
