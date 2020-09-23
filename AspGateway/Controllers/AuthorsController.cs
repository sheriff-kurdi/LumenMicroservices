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
        public string Get()
        {
            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri("http://localhost/LumenMicroservices/AuthorsApi/public/");
            HttpResponseMessage response = client.GetAsync("authors").Result;  // Blocking call!  
            var authors = response.Content.ReadAsStringAsync().Result;
            return authors;

        }

        [HttpGet("{id}")]
        public string Get(int id)
        {
            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri("http://localhost/LumenMicroservices/AuthorsApi/public/");
            HttpResponseMessage response = client.GetAsync($"authors/{id}").Result;  // Blocking call!  
            var authors = response.Content.ReadAsStringAsync().Result;
            return authors;

        }

        [HttpPost]
        public async Task<ActionResult> Post([FromForm] Author author)
        {
            var client = new HttpClient();

            client.BaseAddress = new Uri("http://localhost/LumenMicroservices/AuthorsApi/public/");
            var content = new FormUrlEncodedContent(new[]
            {
                new KeyValuePair<string, string>("name", author.Name),
                new KeyValuePair<string, string>("country", author.Country),
                new KeyValuePair<string, string>("gender", author.Gender),
            });

            var result = await client.PostAsync("authors", content);
            string resultContent = await result.Content.ReadAsStringAsync();
            return Ok(new { resultContent, content });
        }


        [HttpPut("{id}")]
        public async Task<ActionResult> Put([FromForm] Author author, int id)
        {
            var client = new HttpClient();

            client.BaseAddress = new Uri("http://localhost/LumenMicroservices/AuthorsApi/public/");
            var content = new FormUrlEncodedContent(new[]
            {
                new KeyValuePair<string, string>("name", author.Name),
                new KeyValuePair<string, string>("country", author.Country),
                new KeyValuePair<string, string>("gender", author.Gender),
            });


            //content.Headers.Clear();
            //content.Headers.Add("Content-Type", "application/x-www-form-urlencoded");


            var result = await client.PutAsync($"authors/{id}", content);
            string resultContent = await result.Content.ReadAsStringAsync();
            return Ok(new { resultContent, content });
        }

        [HttpDelete("{id}")]
        public async Task<ActionResult> Delete(int id)
        {
            var client = new HttpClient();

            client.BaseAddress = new Uri("http://localhost/LumenMicroservices/AuthorsApi/public/");

            //content.Headers.Clear();
            //content.Headers.Add("Content-Type", "application/x-www-form-urlencoded");

            var result = await client.DeleteAsync($"authors/{id}");
            string resultContent = await result.Content.ReadAsStringAsync();
            return Ok(new { resultContent });
        }
    }
}
