using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Net.Http.Headers;  
using System.Net.Http.Formatting;   
using System.Threading.Tasks;
using AspGateway.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;

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
        public void Post([FromBody] Author author)      
        {           
            using (var client = new HttpClient())  
            {  
                //Author author = new Author { name = "Sourav", Country = "Kayal", Gender = "Kayal"  };  
            client.BaseAddress = new Uri("http://localhost/LumenMicroservices/AuthorsApi/public/");     
                var response = client.PostAsJsonAsync("authors", author).Result;  
                if (response.IsSuccessStatusCode)  
                {  
                    Console.Write("Success");  
                }  
                else  
                    Console.Write("Error");  
            }   
        }    
    }
}
