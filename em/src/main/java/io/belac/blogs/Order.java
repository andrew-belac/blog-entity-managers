package io.belac.blogs;

import io.quarkus.hibernate.orm.panache.PanacheEntity;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import org.hibernate.annotations.CreationTimestamp;
import org.hibernate.annotations.UpdateTimestamp;

import java.time.OffsetDateTime;

@Entity(name = "orders")
public class Order extends PanacheEntity {


    @Column(name = "deliver_to")
    public String deliverTo;
    @Column(name = "delivery_by")
    public OffsetDateTime deliverBy;

    public String reference;

    @Column(name = "created_at")
    @CreationTimestamp
    public OffsetDateTime createdAt;

    @Column(name = "updated_at")
    @UpdateTimestamp
    public OffsetDateTime updatedAt;


}
