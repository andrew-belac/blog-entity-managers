package io.belac.blogs;

import jakarta.inject.Inject;
import jakarta.transaction.Transactional;
import jakarta.ws.rs.GET;
import jakarta.ws.rs.Path;
import jakarta.ws.rs.core.Response;

import java.time.OffsetDateTime;
import java.util.ArrayList;
import java.util.Random;

@Path(("/api"))
public class OrderController {

    @GET
    @Path("/fetch-twice")
    @Transactional
    public Response fetchTwice(){
        var out = new ArrayList<Object>();
        var order1 = Order.findById(1);
        var order2 = Order.findById(1);
        out.add(System.identityHashCode(order1));
        out.add(System.identityHashCode(order2));
        out.add(order1 == order2);
        return Response.ok(out).build();
    }


    @GET
    @Path("/save-twice")
    @Transactional
    public Response saveTwice(){
        var order = (Order) Order.findById(1);
        var random = new Random();
        order.deliverTo = tos[random.nextInt(2)];
        order.persist();
        order.deliverBy = OffsetDateTime.now();
        order.persist();
        return Response.ok().build();
    }

    @GET
    @Path("/by-id-and-reference")
    @Transactional
    public Response byReference(){
        var out = new ArrayList<Object>();
        var order1 = (Order) Order.findById(1);
        var order2 = (Order) Order.find("reference = ?1", order1.reference).firstResult();
        out.add(System.identityHashCode(order1));
        out.add(System.identityHashCode(order2));
        out.add(order1 == order2);
        return Response.ok(out).build();
    }

    private Order factory(){
        var order = new Order();
        var random = new Random();
        order.deliverTo = OrderController.tos[random.nextInt(2)];
        order.deliverBy = OffsetDateTime.now().minusSeconds(random.nextInt(100000));
        order.reference = this.randomString();
        return order;
    }

    private String randomString(){
        String alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // create random string builder
        StringBuilder sb = new StringBuilder();

        // create an object of Random class
        Random random = new Random();

        // specify length of random string
        int length = 15;

        for(int i = 0; i < length; i++) {

            // generate random index number
            int index = random.nextInt(alphabet.length());

            // get character specified by index
            // from the string
            char randomChar = alphabet.charAt(index);

            // append the character to string builder
            sb.append(randomChar);
        }

        return sb.toString();
    }
    private static final String[] tos = {"John", "Mary", "Wayne"};
}
