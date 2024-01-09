package io.belac.blogs;

import com.github.javafaker.Faker;
import jakarta.enterprise.inject.Produces;


public class FakerBean {
    @Produces
    public Faker getFaker(){
        return new Faker();
    }
}